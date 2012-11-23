<?php
/* util of Memcached */
class Cache {
  private $mc;
  private $isOK;
  private static $pool_size = 5;

  private static $singlton;

  public static function getInstance() {
  if (!self::$singlton) self::$singlton = new Cache();
  return self::$singlton;
  }
  
  private function __construct () {
  // pick one connection from pool
  $this->mc = new Memcached('story_pool'.rand(1, self::$pool_size));

  // useful because other libketama-based clients (Python, Ruby, etc.)
  // with the same server configuration will be able to access the keys transparently.
  $this->mc->setOption(Memcached::OPT_LIBKETAMA_COMPATIBLE, TRUE);

  // The list of all servers in the server pool.
  // re-add servers resulting in many simultaneous open connections
  // make sure one instance open one connect for each server
  if (!count($this->mc->getServerList())) {
    $this->isOK = $this->mc->addServer('192.168.0.102', 11211);
  }
  }

  public function __call($method, $params) {
  return $this->isOK && is_callable(array($this->mc, $method))
    ? call_user_func_array(array($this->mc, $method), $params)
    : FALSE;
  }

  // cache stampede: multiple clients working on fetch datea and update cache
  public function fetchUpdate($key, $fetch_func) {
  if (!$this->isOK) return FALSE;
  
  // before working on fetch, get lock
  $lockKey = "$key:lock";

  while(1) {
    if ($returnVal = $this->mc->get($key)) {
    break;
    // someone work on fetch the date and put on cache
    } else if ($this->mc->get($lockKey)) {
    usleep(500000);
    // i will fetch the date and put it on cache
    } else {
    $this->mc->set($lockKey, 1);
    $returnVal = call_user_func_array(array_shift($fetch_func), $fetch_func);
    $this->mc->set($key, $returnVal);
    $this->mc->delete($lockKey);
    break;
    }
  }

  return $returnVal;
  }
}
