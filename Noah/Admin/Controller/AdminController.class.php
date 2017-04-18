<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends CommonController {
    public function _initialize(){
        parent::_initialize();
    }
    
    public function index() {
    	$notlist = M('notice')->where()->order('id desc')->limit(5)->select();
    	$memolist = M('memo')->where(array('uid'=>session('uid')))->order('id desc')->limit(5)->select();
    	$this->notlist = $notlist;
    	$this->memolist = $memolist;
    	$this->display();
    }
}