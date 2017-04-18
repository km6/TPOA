<?php
namespace Admin\Controller;
use Think\Controller;
class MessageController extends CommonController {
	public function _initialize(){
		parent::_initialize();
	}
	
	public function index() {
		$this->display();
	}
	
	public function newMsg() {
		if (IS_POST) {
			$data['from'] 	= session('uid');
			$data['to']		= I('post.to');
			$data['title']	= I('post.title');
			$data['content']= I('post.content');
			$data['sendtime']= time();
			$res = M('message')->add($data);
			if ($res) {
				$this->success('消息发送成功！',U('Message/sendbox'));
			} else {
				$this->error('消息发送失败！',U('Message/sendbox'));
			}
		} else {
			$this->to = M('user')->where('id!=1')->field('id,username')->select();
			$this->display();
		}
	}
	
	public function sendbox() {
		$uid = session('uid');
		$message = M('message');
		$nowpage = $_GET['p']?$_GET['p']:1;
		$msgList = $message->alias('msg')
					->join('left join noah_user user on msg.from=user.id')
					->where(array('msg.from'=>$uid))
					->field('msg.*,user.username')
					->order('sendtime desc')
					->page($nowpage.',20')
					->select();
		$count = $message->where(array('from'=>$uid))->count();
		$Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		foreach($map as $key=>$val) {
			$Page->parameter[$key] = urlencode($val);
		}
		$Page->lastSuffix=false;
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('map',$map);
		$this->msgList = $msgList;
		$this->display();
	}
	
	public function inbox()  {
		$uid = session('uid');
		$msgList = M('message')->alias('msg')
					->join('left join noah_user user on msg.from=user.id')
					->where(array('msg.to'=>$uid))
					->field('msg.*,user.username')
					->order('sendtime desc')
					->select();
		$this->msgList = $msgList;
		$this->msgstatus = $this->getOption('msgstatus');
		$this->display();
	}
	
	public function detail()  {
		$id = I('id');
		$message = M('message');
		$user	 = M('user');
		$msginfo = $message->alias('msg')
					->where(array('msg.id'=>$id))
					->find();
		$this->from = $user->where('id='.$msginfo['from'])->getField('username');
		$this->to = $user->where('id='.$msginfo['to'])->getField('username');
		$f = ($msginfo['from'] != session('uid'));
		$t = ($msginfo['to'] != session('uid'));
		if ($f && $t) {
			$this->error('您无权查看此消息！');
		} else {
			if (!$msginfo['is_red']) {
				$message->where(array('id'=>$id))->setField('is_read', 1);
			}
			$this->msginfo = $msginfo;
			$this->display();
		}
	}
}