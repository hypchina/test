<?php
namespace Api\Model\actionPackage;

use Think\Model;

class TokenModel extends Model{
	
	Protected $autoCheckFields = false;
	
	public function setToken($appKey,$appId){
	   $security=new \Api\Model\toolsPackage\DatasecurityModel();
	   $token=$security->dataSecurity($appKey,$operation='ENCODE',$appId);
	   $token=$token!=''?$token:-1;
	   return $token;
	}
	
	
	public function getAppKeyByToken($tokin){
		$security=new \Api\Model\toolsPackage\DatasecurityModel();
		$appId=D('xxx')->getAppIdByUserId();
		$appKey=$security->dataSecurity($appKey,$operation='DECODE',$appId);
		$appKey=$appKey!=''?$appKey:-1;
		return $appKey;
	}
	
	
}