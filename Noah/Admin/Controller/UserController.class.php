<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {
	public function _initialize(){
		parent::_initialize();
	}
	
	public function userlist() {
		$this->list = M('user')
						->join('left join noah_auth_group_access aga on aga.uid=noah_user.id')
						->join('left join noah_auth_group ag on ag.id=aga.group_id')
						->where('ag.id > 1')
						->field('noah_user.Id as id,noah_user.username,ag.title,noah_user.email')
						->order('noah_user.Id desc')
						->select();
		$this->display();
	}
	
	/*
	 * @author kemao_000
	 */
	public function add() {
		if (IS_POST) {
			$user = M('user');
			$data['username']	= I('username');
			$data['password']	= md5(I('password'));
			$data['email']		= I('email');
			$uid = $user->add($data);
			$res = M('auth_group_access')->add(array('uid'=>$uid,'group_id'=>I('group_id')));
			if ($uid && $res) {
				$this->success('添加管理员成功！',U('User/userlist'));
			} else {
				$this->error('添加管理员失败！',U('User/userlist'));
			}
		} else {
			$this->group = M('auth_group')->select();
			$this->display();
		}
	}
	
	/*
	 * @author kemao_000
	 */
	public function update() {
		$id = I('id');
		$user = M('user');
		if (IS_POST) {
			$data['username']	= I('username');
			if (I('password')) {
				$data['password']	= md5(I('password'));
			}
			$data['email']		= I('email');
			$res1 = $user->where('Id='.$id)->save($data);
			$res2 = M('auth_group_access')->where('uid='.$id)->setField('group_id',I('group_id'));
			if ($res1 === false && $res2 === false) {
				$this->error('管理员修改失败！',U('User/userlist'));
			} else {
				$this->success('管理员修改成功！',U('User/userlist'));
			}
		} else {
			$userinfo = $user->where('id='.$id)
						->join('left join noah_auth_group_access aga on aga.uid=noah_user.id')
						->find();
			$group = M('auth_group')->select();
			$this->userinfo = $userinfo;
			$this->group = $group;
			$this->display();
		}
		
	}
	
	/*
	 * @author kemao_000
	 */
	public function role() {
		$rolist = M('auth_group')->order('id desc')->select();
		$this->list = $rolist;
		$this->display();
	}
	
	/*
	 * @author kemao_000
	 */
	public function add_role() {
		if (IS_POST) {
			$data['title'] 	= I('title');
			$data['status'] = 1;
			$res = M('auth_group')->add($data);
			if ($res) {
				$this->success('添加角色成功！',U('User/role'));
			} else {
				$this->error('添加角色失败！',U('User/role'));
			}
		} else {
			$this->display();
		}
	}
	
	/*
	 * @author kemao_000
	 */
	public function update_role() {
		$id = I('id');
		if (IS_POST) {
			$data['title'] 	= I('title');
			$data['status'] = 1;
			$res = M('auth_group')->add($data);
			if ($res) {
				$this->success('添加角色成功！',U('User/role'));
			} else {
				$this->error('添加角色失败！',U('User/role'));
			}
		} else {
			$this->info = M('auth_group')->where('id='.$id)->find();
			$this->display();
		}
	}
	/*
	 * @author kemao_000
	 */
	public function authority() {
		$id = I('id');
		$auth_group = M('auth_group');
		if (IS_POST) {
			$auth = I('auth');
			$str = '';
			foreach ($auth as $val) {
				$str.=$val.',';
			}
			$str = rtrim($str,',');
			$res = $auth_group->where('id='.$id)->setField('rules',$str);
			if ($res === false) {
				$this->error('权限保存失败！',U('User/role'));
			} else {
				$this->success('权限保存成功！',U('User/role'));
			}
		} else {
			$rules = $auth_group->where('id='.$id)->getField('rules');
			$rules = explode(',', $rules);
			$menus = $this->getNodeList();
			foreach ($menus as $key=>$val) {
				$str = '|--';
				for ($i=0;$i<$val['count'];$i++) {
					$str.='----';
				}
				if (in_array($val['rule_id'], $rules)) {
					$menus[$key]['checked'] = 'checked';
				}
				$menus[$key]['name'] = $str.$val['name'];
			}
			$this->menus = $menus;
			$this->display();
		}
	}
}