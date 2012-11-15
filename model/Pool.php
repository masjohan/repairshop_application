<?php
    declare(ticks = 1);

    class Pool_Manager {

        protected $max_num_worker = 5;  /* size of worker pool */
        protected $worker_num = 0;      /* current number of workers*/

        private $process_id;        /* current process pid */
        protected $ipc_key;         /* IPC key for messaging, semaphore, etc. */
        protected $ipc_msg;

        public function __construct() {

            $this->ipc_key = ftok(__FILE__, 't');

            $this->process_id = posix_getpid();

            $this->create_workers();

            pcntl_signal(SIGCHLD, array($this, 'on_worker_exit'));

            $this->ipc_msg = msg_get_queue($this->ipc_key);

        }

        private function on_worker_exit() {
            while( ($return_child = pcntl_wait($status, WNOHANG)) > 0 ) {
                print "child $return_child return \n";
                $this->worker_num--;
            }
        }

        private function create_workers() {

            while ($this->worker_num < $this->max_num_worker) {
                $pid = pcntl_fork();

                if ($pid == -1) {
                     return false;

                } else if ($pid) {
                    print "created child $pid\n";
                    $this->worker_num++;

                } else {
                    // child and worker
                    new Worker($this->ipc_key, $this->process_id);
                    exit(0);
                }
            }
        }

        public function halt() {
            // tell all workers to exit;
            while ( $this->worker_num ) {
                $this->assign_task(array('exit' => 1));
            }

            // teardown the ipc
            msg_remove_queue($this->ipc_msg);

        }

        public function assign_task($data) {
            // wait for the next free worker
            if ($this->worker_num && msg_receive($this->ipc_msg, $this->process_id ,$msgtype, 65536, $child_id, true, 0, $err)) {
                // send the job to this child
                msg_send ($this->ipc_msg, $child_id, $data, true, true, $err);
                return true;
            }

            return false;
        }

        public function demo() {

            foreach (array(
                'tiger',
                'dog',
                'chicken',
                'pig',
                'cat',
            ) as $message) {
                $this->assign_task(array('task' => "$message"));
            }
        }

    }

    $start_time = microtime(true);

    $man = new Manager();
    $man->demo();

    $man->halt();
    print (microtime(true) - $start_time)."s done\n";

