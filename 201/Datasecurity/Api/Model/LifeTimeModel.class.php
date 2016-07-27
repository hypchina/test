<?php
namespace Api\Model;

use Think\Model;
class LifeTimeModel extends Model{
    Protected $autoCheckFields = false;
    protected $model;
    public function __construct(){
        $this->model = new \Org\Tools\TimeApi();
    }
    /**
     * 获取当前北京时间
     * $a_parm 参数
     * return {sucess:1,result:xxx}
     */
    public function getTimestamp($format){
        $a_parm['app'] = 'life.time';
        $a_parm['format'] = $format?$format:'json';
        $result = $this->model->callapi($a_parm);
        $callback = I('jsoncallback');
        //jsonp
        if(!empty($callback) ){
            return $callback."(".json_encode($result).")";
        }
        return $result;
    }
}

?>