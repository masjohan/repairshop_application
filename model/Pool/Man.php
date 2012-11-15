<?php
    class Busy {
        protected   $ipc_key;   /* IPC key for messaging, semaphore, etc. */
        private     $sem;       /* semaphore */

        public function __construct($ipc_key = NULL) {
            $this->ipc_key = $ipc_key ? $ipc_key : ftok(__FILE__, 't');
            $this->sem = sem_get($this->ipc_key);
        }

        protected function busy_call($method/* parameter */) {
            sem_acquire($this->sem);

            $params = array_slice(func_get_args(),1);
            $result = call_user_func_array(array($this, $method), $params);

            sem_release($this->sem);
            return $result;
        }

        public function __destruct() {
            sem_remove($this->sem);;
        }
    }

    class Pool_Manager extends Busy {

        protected   $max_num_worker;  /* size of worker pool */
        protected   $workers;         /* track of workers */
        private     $children_num;      /* track of all children worker + receipt */

        private     $process_id;        /* current process pid */
        protected   $ipc_msg;

        public function __construct() {

            parent::__construct();

            /* instance var */
            $this->max_num_worker = 2;  /* size of worker pool */
            $this->workers = array();   /* track of workers */
            $this->children_num = 0;   /* track of all children worker + receipt */
            $this->process_id = posix_getpid();
            $this->ipc_msg = msg_get_queue($this->ipc_key);

            /* create worker and watch them exit */
            pcntl_signal(SIGCHLD, array($this, 'on_worker_exit'));
            $this->create_workers();
        }

        public function udpate_child_num($inc = NULL) {
            if($inc) $this->children_num += $inc;
            return $this->children_num;
        }

        private function on_worker_exit() {
            while( ($return_child = pcntl_wait($status, WNOHANG)) > 0 ) {
                $remain = $this->busy_call('udpate_child_num', -1);

                $idx = array_search($return_child, $this->workers);
                if ($idx === FALSE) {
                    // print "recept $return_child return :$remain\n";
                } else {
                    array_splice($this->workers, $idx, 1);
                    // print "worker $return_child return :$remain\n";
                }

            }
        }

        private function create_workers() {

            while (count($this->workers) < $this->max_num_worker) {
                $pid = pcntl_fork();

                if ($pid == -1) {
                     return FALSE;

                } else if ($pid) {
                    // print "created child $pid\n";
                    $this->workers[] = $pid;
                    $this->busy_call('udpate_child_num', 1);

                } else {
                    // child and worker
                    new Worker($this->ipc_key, $this->process_id);
                    exit(0);
                }
            }
        }

        public function halt() {
            // tell all workers to exit;
            while (count($this->workers)) {
                $this->dispatch('_$EXIT', FALSE);
            }

            while($this->busy_call('udpate_child_num')) sleep(10);

            // teardown the ipc
            msg_remove_queue($this->ipc_msg);

        }

        public function dispatch($data, $response = TRUE) {

            // wait for worker
            if (!msg_receive($this->ipc_msg, $this->process_id ,$msgtype, 65536, $child_id, TRUE, 0, $err)) return FALSE;

            // fork
            $pid = pcntl_fork();
            if ($pid) {
                $this->busy_call('udpate_child_num', 1);
                return TRUE;
            }

            // child: create task
            $task = array('task'=>$data);
            if ($response) $task['task_id'] = posix_getpid();

            // send the task
            if (!msg_send ($this->ipc_msg, $child_id, $task, TRUE, TRUE, $err)) exit(1);

            // wait for result
            if ($response) {
                if (!msg_receive($this->ipc_msg, $task['task_id'] ,$msgtype, 65536, $result, TRUE, 0, $err)) exit(2);
                // print "{$task['task_id']} received $result from $child_id\n";
            }
            exit(0);
        }

    }

