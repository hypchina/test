<?php
/** 
*
* @平台哈希模块 
* @author jfq
* 
*/ 
namespace Api\Model\dataPackage;
use Think\Model;
class PlatformModel extends Model{

    protected $autoCheckFields = false;
	protected $tableName='platform_hash';

	/*
		@获取hash值
		@return array	
	*/
	public function getHash(){
		return $this->where('hash_id=1')->getField('hash_val');
	}
	
	/*
		@设置hash值 
		@$hash string 新hash值
		@return array
	*/
	public function setHash($hash){
		return $this->where('hash_id=1')->setField('hash_val',$hash);
	}
}