<?php
namespace Api\Controller;
use Think\Controller;
class TController extends Controller{
	
	public function index(){
		G('begin');
		
		//echo phpinfo();die;
		$Model= \Api\Model\actionPackage\CertificationModel::createCertification();
		$Model=new  \Api\Model\toolsPackage\RandModel();
		 //$Model=new  \Api\Model\actionPackage\UserModel();
		 //$data['username']='jiang';
		// $data['userpass']='12345';
		// $userInfo=$Model->authLogin($data);
		// var_dump($userInfo);
		//$rand=$Model->getRand(16,5);
		//var_dump($rand);
		//$Model->createCertfication();
		//$M->
		//var_dump($M->getHash());
		G('end');
		echo G('begin','end').'s';
	}
	
}