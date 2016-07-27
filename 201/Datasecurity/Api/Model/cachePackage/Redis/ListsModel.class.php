<?php
namespace Api\Model\cachePackage\Redis;
/**
 * redis 链表操作类
 * @author hyp
 *
 */
class ListsModel extends BaseModel{
    protected $keyName = null;
    
    public function __construct($keyName,$params=array()){
        parent::__construct($params);
        if(empty($keyName)){
            throw new \Exception('链表名称不能为空', -1);
        }
        $this->keyName = $keyName;
    }
    /**
     * 切换链表
     * @param string $key 链表名称
     */
    public function selectTable($key){
        if(empty($key))
            throw new \Exception('链表名称不能为空', -1);
        $this->keyName = $key;
    }
    
    public function get($index=0){
        return $this->handler->lindex($this->keyName,$index?$index:0);
    }
    /**
     * 获取该链表中所有的内容
     * return array
     */
    public function getAll(){
        return $this->handler->lrange($this->keyName,0,-1);
    }
    
    public function add($val){
       return $this->handler->rPush($this->keyName,$val);
    }
    /**
     * 删除链表中的第一个元素
     * return string 返回删除的元素值
     */
    public function delTop(){
        return $this->handler->lPop($this->keyName);
    }
    /**
     * 删除尾部元素
     * @return 返回删除的元素值
     */
    public function delTail(){
        return $this->handler->rPop($this->keyName);
    }
    /**
     * 设置对应下标的值
     * @param string $value
     * @return boolean
     */
    public function save($index,$value){
        if(isset($index)){
            return $this->handler->lSet($this->keyName,$index,$value);
        }
        return false;
    }
    /**
     * 获取链表中元素个数
     * @param string $key
     * return int
     */
    public function getSize(){
        return $this->handler->lLen($this->keyName);
    }
    
    public function getQueue(){
        if($this->getSize()>0){
            return $this->delTop();
        }
        return false;
    }
    
}

?>