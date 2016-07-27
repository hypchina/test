<?php
namespace Api\Model\hashPackage;

/*
 * author 杨鹏
 * 
 * 
 */

use Think\Model;
class HashModel extends Model{
	Protected $autoCheckFields = false;
	
	/*
	 * 文件hash  平台hash
	 * @param string $msg     签名信息
	 * @param string $key     文件hash（平台hash）
	 * @param string $rand    随机数
	 * @param string $time    时间戳
	 * @param string $key     平台hash
	 * @param string $method  签名算法
	 * 
	 */
	
	public function getHash($msg,$rand,$time,$key,$method="HS256"){
		$methods = array(
				'HS256' => 'sha256',
				'HS384' => 'sha384',
				'HS512' => 'sha512',
		);
		$msg=$msg.$rand.$time.$key;
		return hash_hmac($methods[$method],$msg,$key,false);
	}
	

	
}