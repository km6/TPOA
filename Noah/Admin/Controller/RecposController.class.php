<?php
namespace Admin\Controller;
use Think\Controller;
class RecposController extends CommonController {
	public function _initialize(){
		parent::_initialize();
		$this->recpos = D('recpos');
	}
	public function index(){
		$this->list = $this->recpos->select();
		$this->display();
	}
}