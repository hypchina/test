<?php
/** 
*
* @证书模块 
* @author jfq
* 
*/  
namespace Api\Model\dataPackage;
use Think\Model;
class CertificationModel extends Model{

    protected $autoCheckFields = false;
	public $pageNum=20;

	//验证规则
	protected $_validate = array(
		array('uid','require','用户id错误'),
        array('data_name','require','请填写文件名'),
        array('data_type',array(10,20,30,40),'请选择正确的数据类型',2,'in'), 
		array('salt','require','随机数错误'),
		array('timestamp','require','时间戳错误'),
		array('platform_hash','require','平台hash错误'),
	)
	
	/*
		获取单条证书信息
		@$condition['cert_id'] int 证书id
		@return array
	*/
	public function getCertInfo($condition,$field=''){
		if($field==''){
			$field='cert_id,cert_sn';
		}
		return $this->field($field)->where($condition)->find();
	}
	
	/*
		获取证书列表
		@$condition['uid'] int 用户id 
		@$field string 查询字段
		@$order string 排序
		@return array
	*/
	public function certList($condition,$field='',$order='cert_id desc'){
		if($field==''){
			$field='cert_id,cert_sn';
		}
		$data=array();
		$data['count']=$this->where($condition)->count();
		$page =new \Think\Page($data['count'],$this->pageNum);
		$data['list']=$this->field($field)->where($condition)->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();
		$data['page']=$page->show();
		return $data;
	}
	
	/*
		@certData array
		@certData['uid']  int  用户id
		@certData['data_name'] string 文件名
		@certData['data_type'] string 文件类型
		@certData['salt'] string 随机数，盐值
		@certData['timestamp'] string 时间戳
		@certData['platform_hash'] string 平台哈希
		@certData['cert_stamp'] string 最终电子戳
		@return array 
	*/
	public function createCert($certData=array()){
		$certData['cert_sn']= \Api\Model\actionPackage\SnModel::getSN();
		$result=$this->add($certData);
		return $result;
	}
}