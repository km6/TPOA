<?php
namespace Admin\Controller;
use Think\Controller;
class ProjectController extends CommonController {
	public function _initialize(){
		parent::_initialize();
	}
	public function index () {
		$project = M('project');
		$name = I('get.name');
		$name = urldecode($name);
		if ($this->groups[0][group_id] != 4){
			$str = 'supervisor='.session('uid');
		} 
		if(!empty($name)){
			$str.=(" and (noah_project.name like '%".$name."%' or noah_project.project_sn like '%".$name."%')");
			$map['name'] = $name;
		}
		$nowpage = $_GET['p']?$_GET['p']:1;
		$this->list = $project->where($str)->order('id desc')
					->page($nowpage.',20')
					->select();
		$count=$project->where($str)
					->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		foreach($map as $key=>$val) {
			$Page->parameter[$key] = urlencode($val);
		}
		$Page->lastSuffix=false;
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('map',$map);
		$this->assign('name',$name);
		$this->projStatus = $this->getOption('projStatus');
		$this->display();
	}
	
	public  function _before_insert($data){
		$data['opening_date'] = strtotime($data['opening_date']);
		$data['publicity_date'] = strtotime($data['publicity_date']);
		$data['extract_date'] = strtotime($data['extract_date']);
		$data['closing_date'] = strtotime($data['closing_date']);
		$data['supervisor'] = session('uid');
		return $data;
	}
	
	public  function _before_update($data){
		if ($this->groups[0]['group_id'] == 2) {
			$data['opening_date'] = strtotime($data['opening_date']);
			$data['publicity_date'] = strtotime($data['publicity_date']);
			$data['extract_date'] = strtotime($data['extract_date']);
			$data['closing_date'] = strtotime($data['closing_date']);
			return $data;
		} else {
			$this->error('您没有权限进行此操作！',U('Project/index'));
			exit();
		}
		
	}
	
	public function _before_edit() {
		$users = M()->table('noah_user user')
					->join('left join noah_auth_group_access group_access on user.Id=group_access.uid')
					->join('left join noah_auth_group authgroup on group_access.group_id=authgroup.id')
					->where('authgroup.id='.$this->groups[0]['group_id'])
					->field('user.Id,user.username')
					->select();
		$leaders = M()->table('noah_user user')
					->join('left join noah_auth_group_access group_access on user.Id=group_access.uid')
					->join('left join noah_auth_group authgroup on group_access.group_id=authgroup.id')
					->where('authgroup.id=4')
					->field('user.Id,user.username')
					->select();
		$this->leaders = $leaders;
		$this->users = $users;
	}
	
	public function _before_add() {
		$leaders = M()->table('noah_user user')
					->join('left join noah_auth_group_access group_access on user.Id=group_access.uid')
					->join('left join noah_auth_group authgroup on group_access.group_id=authgroup.id')
					->where('authgroup.id=4')
					->field('user.Id,user.username')
					->select();
		$this->leaders = $leaders;
	}
	
	public function delete(){
		$proj_id = I('post.proj_id');
		$fee_application = M('fee_application');
		$fcount = $fee_application->where('proj_id='.$proj_id)->select();
		$reim = M('reimbursement');
		$rcount = $reim->where('proj_id='.$proj_id)->select();
		if ($fcount) {
			$this->error('该项目已申请费用，无法删除！',U('Project/index'));
		} elseif ($rcount) {
			$this->error('该项目已报销费用，无法删除！',U('Project/index'));
		} else {
			$res1 = M('project')->where('id='.$proj_id)->delete();
			$res2 = M('lot')->where('proj_id='.$proj_id)->delete();
			if ($res1 === false || $res2 === false) {
				$this->error('删除失败！',U('Project/index'));
			} else {
				$this->success('删除成功！',U('Project/index'));
			}
		}
	}
	
	/*
	 * @author kemao_000
	 * 项目移交
	 */
	public function transfer() {
		$id = I('post.id');
		$uid = I('post.uid');
		$res = M('project')->where('id='.$id)->setField('supervisor',$uid);
		if ($res === false) {
			$this->error('项目移交失败！',U('Project/index'));
		} else {
			$this->success('项目移交成功！',U('Project/index'));
		}
	}
	
	 /*
	  * 项目编号查询是否重复的接口
	  */
	public function ajaxCheckProjSn() {
		$sn = I('post.sn');
		$count = M('project')->where('project_sn=\''.$sn.'\'')->count();
		if ($count !== false){
			$this->ajaxReturn($count);
		}
	}
}