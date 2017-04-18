<?php
namespace Admin\Controller;
use Think\Controller;
class NoticeController extends CommonController {
	public function _initialize(){
		parent::_initialize();
	}
	
	public function index() {
		$nowpage = $_GET['p']?$_GET['p']:1;
		$notice = M('notice');
		$notlist = $notice->where()->order('id desc')->page($nowpage.',20')->select();
		$count = $notice->count();
		$Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		foreach($map as $key=>$val) {
			$Page->parameter[$key] = urlencode($val);
		}
		$Page->lastSuffix=false;
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('map',$map);
		$this->notlist = $notlist;
		$this->display();
	}
	
	public function _before_insert($data) {
		$data['add_time'] = time();
		return $data;
	}
	
	public function detail() {
		$id = I('get.id');
		$notice = M('notice')->where(array('id'=>$id))->find();
		$this->notice = $notice;
		$this->display();
	}
	
	public function delete()  {
		$id = I('post.proj_id');
		$res = M('notice')->where(array('id'=>$id))->delete();
		if ($res === false) {
			$this->error('删除失败！',U('Notice/index'));
		} else {
			$this->success('删除成功！',U('Notice/index'));
		}
	}
}