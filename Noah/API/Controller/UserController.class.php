<?php
namespace API\Controller;
use Think\Controller;
class UserController extends CommonController {
	public function _initialize() {
        $this->member = D('member');
    }
	//获取用户信息
	public function getInfo(){
		if ($this->is_login()) {
			$user = session('user');
			$userinfo = $this->member->where(array('id'=>$user['id'],'is_del'=>0))->find();
			$userinfo['password'] = '';
			$this->render_JSON($userinfo);
		} else {
			$msg = '用户未登录!';
			$this->render_JSON(array(),$msg);
		}
	}
	//用户登录
    public function login(){
    	if (IS_POST) {
    		//$member = M('member');
    		$phone = I('phone');
    		$password = I('password');
    		$user = $this->member->where(array('phone'=>$phone,'is_del'=>0))->find();
    		if ($user['password'] == md5($password)) {
    			$data['id'] = $user['id'];
    			$data['membername'] = $user['membername'];
    			$data['address'] = $user['address'];
    			$data['peisongweight'] = $user['peisongweight'];
    			$data['peisongtime'] = $user['peisongtime'];
    			session('user',$data);
    			$msg = '登录成功!';
    			$this->render_JSON($data,$msg);
    		} else {
    			$msg = '用户名或密码错误!';
    			$this->render_JSON(array(),$msg);
    		}
    		
    	}
    }
}