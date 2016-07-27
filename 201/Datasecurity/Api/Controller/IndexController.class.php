<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        //vendor('phpqrcode\phpqrcode');
        \Api\Model\toolsPackage\QRcodeModel::creatQRcodeForLogo('http://www.baidu.com','Public/QRcode/2.png',false,H,8,5);
        //$a = \QRcode::text("http://www.baidu.com", false, QR_ECLEVEL_L, 6, 7);
        //dump($a);
    }
}