<?php
namespace API\Controller;
use Think\Controller;
class CommonController extends Controller {
	//返回json数据的通用函数
    public function render_JSON($data = array(), $msg = '', $status = true, $error_code = 0){
    	$Jdata['status'] = $status;
    	$Jdata['error_code'] = $error_code;
    	$Jdata['data'] = $data;
    	$Jdata['msg'] = $msg;
    	echo json_encode($Jdata);
    }

    //获取用户登录状态
    public function is_login(){
    	$sess=session('user');
		if($sess['id']){
			return $sess;
		}else{
			return 0;
		}
    }

    //获取首页推荐位
    public function getRecPosition(){
    	$cais = D('cais');
    	$ctid = I('ctid');
    	$rList = $cais->where(array('is_rec'=>1,'ctid'=>$ctid))->field('id,name,imgurl')->limit(3)->select();
    	$this->render_JSON($rList);
    }
    //获取菜品列表
    public function getCaiList(){
    	$cais = D('cais');
    	$ctid = I('ctid');
    	$caiList = $cais->where(array('is_rec'=>0,'ctid'=>$ctid))->field('id,name,imgurl')->select();
    	$this->render_JSON($caiList);
    }
    //获取菜品详情
    public function getCaiDetails(){
    	$cais = D('cais');
    	$id = I('id');
    	$cai = $cais->where(array('id'=>$id))->find();
    	$this->render_JSON($cai);
    }
    //获取下拉菜单
    public function getSubMnu(){
    	$category = I('category');
    	$caitype = D('caitype');
    	$subMenu = $caitype->where(array('category'=>$category))->select();
    	$this->render_JSON($subMenu);
    }
    //获取菜品规格
    public function getCaiSKU(){
    	$caiSKU = D('cai_sku');
    	$cai_id = I('id');
    	$skuList = $caiSKU->where(array('cai_id'=>$cai_id))->select();
    	$this->render_JSON($skuList);
    }
}