<?php
/** 
*
* @֤�齻��ģ�� 
* @author jfq
* 
*/ 
namespace Api\Model\actionPackage;
use Think\Model;
class CertificationModel{
	
	/*
		 @�ϴ��ļ�����֤��
		 @$data array 
		 @return array
	*/
	public static function createCertification($data){
		
		//���ݿ��ȡƽ̨hash
		$PlatformModel= new \Api\Model\dataPackage\PlatformModel;
		$platformHash=$PlatformModel->getHash();
	}
}