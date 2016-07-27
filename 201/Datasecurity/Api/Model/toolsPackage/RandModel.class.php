<?php
/*
 * 
 * author 杨鹏
 * 
 * 获取随机数 时间戳
 * 
 * 
 */
namespace Api\Model\toolsPackage;

use Think\Model;
class RandModel extends Model{
	Protected $autoCheckFields = false;
	
	
	/*
	 * 
	 * @param string $num   总长度
	 * @param string $zimu   字母长度
	 * return String $string   随机字符串
	 */
	public function getRand($num=16,$zimu=4){
		$letter="abcdefghijklmnopqrltuvwsyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $letter=substr(str_shuffle($letter),0,$zimu);
		for($i=0;$i<$num-$zimu;$i++){
		  $letter.=(string)rand(0,9);
		}
		return str_shuffle($letter);
	}
	
	/*
	 * 获取key
	 */
	public function getkey(){
		return time().$this->getRand(5,1);
	}
	public function getTime(){
		return time();
	}
	
}