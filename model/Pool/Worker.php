<?php

    class Pool_Worker {

        private $ipc_key;       /* all sem shm and msg will used this key - gentleman: READONLY */
        private $parent_id;     /* parent process id */
        private $process_id;    /* current process (child) id */

        final public function __construct($ipc_key, $parent_id) {
            $this->ipc_key = $ipc_key;
            $this->parent_id = $parent_id;
            $this->process_id = posix_getpid();

            $this->init();
            $this->wait_task();
        }

        private function wait_task () {

            $msg = msg_get_queue($this->ipc_key);

            $done = FALSE;

            // tell parent that "I am free, give me the job"
            while (msg_send ($msg, $this->parent_id, $this->process_id, TRUE, TRUE, $err) && !$done) {

                // wait for my task
                if (!msg_receive($msg, $this->process_id ,$msgtype, 65536, $data, TRUE, 0, $err)) continue;

                if(!$data['task']) continue;

                if ($data['task'] === '_$EXIT') {
                    $result = "$this->process_id is shuting down ...";
                    $done = TRUE;
                } else {
                    $result = $this->work($data['task']);
                }

                // task has id, send back result
                if ($data['task_id']) {
                    msg_send ($msg, $data['task_id'], $result, TRUE, TRUE, $err);
                }
            }

        }

        /* do any init thing here */
        protected function init() {}

        /* do real thing here */
        protected function work($data) {}

    }


