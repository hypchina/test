<?php
namespace Api\Model\cachePackage\Redis;
/**
 * redis Hash表
 * @author hyp
 *
 */
class HashModel extends BaseModel
{
    protected static $errorMsg = null;
    protected static $errorMsgCode = array(
        '-1' => 'hash表名称不能为空',
        '-2' => '查询字段不能为空',
    );
    public function __construct($keyName,$options=array()){
        parent::__construct($options);
        if(empty($keyName)){
            throw new \Exception('hash表名称不能为空', -1);
        }
        $this->keyName = $keyName;
    }
    /**
     * 切换hash表
     * @param string $key
     * @throws \Exception
     */
    public function selectTable($key){
        if(empty($key)){
            throw new \Exception('hash表名称不能为空', -1);
        }
        $this->keyName = $key;
    }
    
    public function delField($field){
        if(empty($field)){
            self::$errorMsg = self::$errorMsgCode['-2'];
            return -2;
        }
        return $this->handler->hDel($this->keyName,$field);
    }
    
    /**
     * 设置hash表中的内容，不存在则添加 存在则修改
     * @param string $field 字段名
     * @param all $value 字段值
     * return 成功 1 失败 false
     */
    public function save($field,$value){
        return $this->handler->hSet($this->keyName,$field,$value);
    }
    /**
     * 设置hash表内容，$param=array(field=>value,...)
     * @param array $param
     * return false | true
     */
    public function saveAll(Array $param){
        return $this->handler->hMset($this->keyName,$param);
    }
    /**
     * 获取hash表中所有内容
     * return array (field=>value,...)
     */
    public function getAll(){
        return $this->handler->hGetAll($this->keyName);
    }
    /**
     * 批量获取当前hash表中对应的filed值
     * return Array
     */
    public function getValuesByFields(array $params=null){
        if(empty($params)){
            return $this->getAll();
        }
        return $this->handler->hMget($this->keyName,$params);
    }
    
    /**
     * 通过字段名获取对应的value
     * @param string $field
     * @return boolean
     */
    public function getValueByField($field){
        if(empty($field)){
            self::$errorMsg = self::$errorMsgCode['-2'];
            return -2;
        }
        return $this->handler->hGet($this->keyName,$field);
    }
    
    /**
     * 获取制定hash表中的field数目
     * return int
     */
    public function getSize(){
        return $this->handler->hLen();
    }
    /**
     * 获取当前hash表名称
     */
    public function getTableName(){
        return $this->keyName;
    }
    
}

?>