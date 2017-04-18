<?php
namespace Admin\Controller;
use Think\Controller;
class MemoController extends CommonController {
	public function _initialize(){
		parent::_initialize();
	}
	
	public function index() {
		$nowpage = $_GET['p']?$_GET['p']:1;
		$this->memolist = M('memo')
						->where(array('uid'=>session('uid')))
						->order('id desc')
						->page($nowpage.',20')
						->select();
		$count =  M('memo')->where(array('uid'=>session('uid')))->count();
		$Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		foreach($map as $key=>$val) {
			$Page->parameter[$key] = urlencode($val);
		}
		$Page->lastSuffix=false;
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('map',$map);
		$this->display();
	}
	
	public function _before_insert($data) {
		$data['uid'] = session('uid');
		$data['addtime'] = time();
		return $data;
	}
	
	public function delete() {
		$id = I('post.proj_id');
		$res = M('memo')->where(array('id'=>$id))->delete();
		if ($res === false) {
			$this->error('删除失败！',U('Notice/index'));
		} else {
			$this->success('删除成功！',U('Notice/index'));
		}
	}
}