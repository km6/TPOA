<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * @author kemao_000
 * @date 2016年2月17日 上午10:37:55  
 *
 */
class IndexController extends Controller {

    public function index(){
    	$this->display();
    }

    public function login(){
    	$this->display();
    }

    public function logout(){
        session(null);
        $this->redirect('Index/login');
    }

    //登录验证
    public function check_login(){
        $User = M('user');
        $verify_code = I('post.verify_code');

        if (!check_verify($verify_code)) {
            $this->error('验证码错误!',U('Index/login'));
        }

        if (!$User->autoCheckToken($_POST)){
            $this->error('非法提交!',U('Index/login'));
        } else {
            $email = I('post.email');
            $password = I('post.password');

            $LoginUser = $User->where(array('email'=>$email))->find();
            if ($LoginUser) {
                if ($LoginUser['password'] == md5($password)) {
                    //登录成功写入用户id
                    session('uid', $LoginUser['id']);
                    session('username', $LoginUser['username']);
                    $this->success('登录成功!',U('Admin/index'));
                } else {
                    $this->error('密码错误!',U('Index/login'));
                }
            } else {
                $this->error('用户不存在!',U('Index/login'));
            }
        }
    }

    //获取验证码
    public function verify_c(){
    	$Verify = new \Think\Verify();  
	    $Verify->fontSize = 18;  
	    $Verify->length   = 4;  
	    $Verify->useNoise = false;  
	    $Verify->codeSet = '0123456789';  
	    $Verify->imageW = 130;  
	    $Verify->imageH = 50;  
	    $Verify->entry();  
    }
}