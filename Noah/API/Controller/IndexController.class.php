<?php
namespace API\Controller;
use Think\Controller;
class IndexController extends CommonController {
	//获取首页推荐位
    public function getIndexRecPosition(){
    	$recpos = M('recpos');
    	$recs = $recpos->where(array('is_show'=>1))->limit(6)->order('id desc')->select();
    	$this->render_JSON($recs);
    }
}