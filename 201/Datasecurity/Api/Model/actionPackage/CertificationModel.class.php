<?php
/** 
*
* @证书交互模块 
* @author jfq
* 
*/ 
namespace Api\Model\actionPackage;
use Think\Model;
class CertificationModel{
	
	/*
		 @上传文件生成证书
		 @$data array 
		 @return array
	*/
	public static function createCertification($data){
		
		//数据库获取平台hash
		$PlatformModel= new \Api\Model\dataPackage\PlatformModel;
		$platformHash=$PlatformModel->getHash();
	}
}