<?php
namespace Api\Model\cachePackage\Redis;

class BaseModel{
    protected $handler = null;
    protected $keyName = null;
    public function __construct($options = array()){
        if (! extension_loaded('redis')) {
            E(L('_NOT_SUPPORT_') . ':redis');
        }
        $options = array_merge(array(
            'host' => C('REDIS_HOST') ?  : '127.0.0.1',
            'port' => C('REDIS_PORT') ?  : 6379,
            'pass' => C('REDIS_PASS') ?  : 'heyipeng',
            'timeout' => C('DATA_CACHE_TIMEOUT') ?  : false,
            'persistent' => false
        ), $options);
    
        $this->options = $options;
        $func = $options['persistent'] ? 'pconnect' : 'connect';
        $this->handler = new \Redis();
        $options['timeout'] === false ? $this->handler->$func($options['host'], $options['port']) : $this->handler->$func($options['host'], $options['port'], $options['timeout']);
        isset($this->options['pass']) && $this->handler->auth($this->options['pass']);
        $this->keyName = $this->options['key'];
    }
    
    /**
     * 切换redis数据库
     * @param int $dbNum 数据库编号 0~15
     * @return boolean
     */
    public function selectDb($dbNum){
        if(is_numeric($dbNum) && $dbNum<16){
            return $this->handler->select($dbNum);
        }else{
            return false;
        }
    }
    
    /**
     * 设置键值过期时间
     * @param string $key 键名
     * @param int $time 时间 单位秒
     * return 1 or false
     */
    public function setExpire($key,$time){
        $key = $key?$key:$this->keyName;
        if(is_numeric($time) && !empty($key)){
            return $this->handler->expire($key,$time);
        }
        return false;
    }
    /**
     * 删除key
     * @param string $key
     * return 1 | 0
     */
    public function delKey($key){
        $key = $key?$key:$this->keyName;
        return $this->handler->del($key);
    }
    /**
     *   获取当前数据库所有key
     *   return array
     */
    public function getAllKeys(){
        return $this->handler->keys('*');
    }
    /**
     * 获取redis对象
     * @return \Redis
     */
    public function getRedis(){
        return $this->handler;
    }
    /**
     * 删除当前数据库中所有key
     */
    public function flushDb(){
        $this->handler->flushDB();
    }
    /**
     * 关闭redis链接
     */
    protected function __destruct(){
        $this->handler->close();
    }
    
}

?>