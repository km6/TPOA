<?php
namespace Admin\Controller;
use Think\Controller;
class FinanceController extends CommonController {
	public function _initialize(){
		parent::_initialize();
	}
	
	/*
	 * @author kemao_000
	 * 费用申请列表
	 */
	public  function  application(){
		$application = M('fee_application');
		$name = I('get.name');
		$name = urldecode($name);
		if(!empty($name)){
			$str.=("p.name like '%".$name."%'");
			$map['name'] = $name;
		}
		$nowpage = $_GET['p']?$_GET['p']:1;
		$appList = $application
					->join('left join noah_project p on noah_fee_application.proj_id=p.id')
					->field('noah_fee_application.*,p.name')
					->where($str)
					->order('id desc')
					->page($nowpage.',20')
					->select();
		$count = $application
					->join('left join noah_project p on noah_fee_application.proj_id=p.id')
					->field('noah_fee_application.*,p.name')
					->where($str)
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
		$this->appList = $appList;
		$this->appStatus = $this->getOption('appStatus');
		$this->display();
	}
	
	/*
	 * @author kemao_000
	 * 费用申请列表
	 */
	public function reimList()  {
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
	
	/*
	 * @author kemao_000
	 * 费用审核列表
	 */
	public  function  auditFees(){
		$application = M('fee_application');
		$name = I('get.name');
		$name = urldecode($name);
		if(!empty($name)){
			$str.=("p.name like '%".$name."%'");
			$map['name'] = $name;
		}
		$nowpage = $_GET['p']?$_GET['p']:1;
		$appList = $application
					->join('left join noah_project p on noah_fee_application.proj_id=p.id')
					->field('noah_fee_application.*,p.name')
					->where($str)
					->order('id desc')
					->page($nowpage.',20')
					->select();
		$count = $application
					->join('left join noah_project p on noah_fee_application.proj_id=p.id')
					->where($str)
					->count();
		$Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		foreach($map as $key=>$val) {
			$Page->parameter[$key] = urlencode($val);
		}
		$Page->lastSuffix=false;
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('map',$map);
		$this->assign('name',$name);
		$this->appList = $appList;
		$this->appStatus = $this->getOption('appStatus');
		$this->display();
	}
	
	/*
	 * @author kemao_000
	 * @return void
	 */
	public  function  apply() {
		$uid = session('uid');
		if (IS_POST) {
			$data['proj_id']	= I('post.proj_id');
			$data['fee']		= intval(I('post.fee'));
			$data['remark']		= I('post.remark');
			$data['status']		= 1;
			$data['applicant']	= $uid;
			$data['addtime']	= time();
			if (M('fee_application')->add($data)) {
				$this->success('申请提交成功！',U('Finance/application'));
			} else {
				$this->error('申请提交失败',U('Finance/application'));
			}
		} else {
			//每个业务经理只能选择自己负责的项目
			$projList = M('project')->where(array('supervisor'=>$uid))->select();
			$this->projList = $projList;
			$this->appStatus = $this->getOption('appStatus');
			$this->display();
		}
	}
	
	public function cancel() {
		$app_id = I('post.app_id');
		$fee_app = M('fee_application');
		$appinfo = $fee_app->where(array('id'=>$app_id))->find();
		if ($appinfo['status']>1) {
			$this->error('该申请已完成审核，无法取消！',U('Finance/application'));
		} else {
			if ($fee_app->where(array('id'=>$app_id))->delete()) {
				$this->success('申请取消成功！',U('Finance/application'));
			} else {
				$this->error('申请取消失败！',U('Finance/application'));
			}
			
		}
	}
	
	/*
	 * @author kemao_000
	 */
	public function check() {
		$application = M('fee_application');
		$id = intval(I('get.id'));
		if (IS_POST) {
			$data['remark'] = I('post.remark');
			$data['status'] = intval(I('post.status'));
			$res = $application->where('id='.$id)->save($data);
			if ($res === false) {
				$this->error('保存失败！', U('Finance/check', array('id'=>$id)));
			} else {
				$this->success('保存成功！', U('Finance/auditFees'));
			}
		} else {
			$projList = M('project')->where()->select();
			$this->projList = $projList;
			$this->info = $application->where('id='.$id)->find();
			$this->appStatus = $this->getOption('appStatus');
			$this->display();
		}
	}
	
	public function endCheck() {
		$project = M('project');
		$name = I('get.name');
		$name = urldecode($name);
		$str.='noah_project.status in (1,3)';
		if(!empty($name)){
			$str.=(" and noah_project.name like '%".$name."%'");
			$map['name'] = $name;
		}
		
		$nowpage = $_GET['p']?$_GET['p']:1;
		$reimbursement = M('reimbursement');
		$list = $project
				->join('left join noah_user user on noah_project.supervisor=user.Id')
				->field('noah_project.id as id,user.username,noah_project.name,noah_project.project_sn')
				->where($str)
				->order('id desc')
				->select();
		$count = $project
				->join('left join noah_user user on noah_project.supervisor=user.Id')
				->where($str)
				->count();
		$Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		foreach($map as $key=>$val) {
			$Page->parameter[$key] = urlencode($val);
		}
		$Page->lastSuffix=false;
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('map',$map);
		$this->assign('name',$name);
		$this->list = $list;
		$this->display();
	}
	
	/*
	 * @author kemao_000
	 */
	public function reimbursement() {
		$id = I('proj_id');
		$project = M('project');
		$this->projInfo = $projInfo = $project->where('id='.$id)->find();
		if (IS_POST) {
			switch ($projInfo['status']) {
				case 0:
				$status = 1;
				break;
				case 2:
				$status = 3;
				break;
			}
			$data['proj_id'] = $id;
			$data['evaluation_fee'] =  I('evaluation_fee');
			$data['venue_fee'] = I('venue_fee');
			$data['travel_fee'] = I('travel_fee');
			$data['travel_member'] = I('travel_member');
			$data['remark'] = I('remark');
			$res = M('reimbursement')->add($data);
			if ($res) {
				//$project->where('id='.$id)->setField('status',$status);
				$this->success('保存成功！',U('Finance/reimList'));
			} else {
				$this->error('保存失败！',U('Finance/reimList'));
			}
		} else {
			if (($projInfo['status'] == 1)||($projInfo['status'] == 3)) {
				$this->error('该项目已报销！',U('Finance/reimList'));
			} else {
				$this->display();
			}
		}
	}
	
	/*
	 * @author kemao_000
	 * 费用结算列表
	 */
	public function billing() {
		$project = M('project');
		$name = I('get.name');
		$name = urldecode($name);
		if(!empty($name)){
			$str.=("project.name like '%".$name."%'");
			$map['name'] = $name;
		}
		$nowpage = $_GET['p']?$_GET['p']:1;
		$reimbursement = M('reimbursement');
		$list = $reimbursement
				->join('left join noah_project project on noah_reimbursement.proj_id=project.id')
				->join('left join noah_user user on project.supervisor=user.Id')
				->field('noah_reimbursement.id,project.name,project.project_sn,user.username')
				->where($str)
				->order()
				->select();
		$count = $reimbursement
				->join('left join noah_project project on noah_reimbursement.proj_id=project.id')
				->join('left join noah_user user on project.supervisor=user.Id')
				->field('noah_reimbursement.id,project.name,project.project_sn,user.username')
				->where($str)
				->count();
		$Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		foreach($map as $key=>$val) {
			$Page->parameter[$key] = urlencode($val);
		}
		$Page->lastSuffix=false;
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('map',$map);
		$this->assign('name',$name);
		$this->list = $list;
		$this->display();
	}
	
	/*
	 * @author kemao_000
	 * 费用结算详情页
	 */
	public function details() {
		$id = I('id');
		$rei = M('reimbursement');
		$reinfo = $rei->where('id='.$id)->find();
		$projinfo = M('project')->where('id='.$reinfo['proj_id'])->find();
		if (IS_POST) {
			$status = I('post.status','intval');
			if ($status == 1) {
				$data['from']	= session('uid');
				$data['to']		= $projinfo['supervisor'];
				$data['title']	= $projinfo['name'].'费用报销审核未通过';
				$data['content']= I('post.opinion');
				$data['sendtime']= time();
				M('message')->add($data);
			} elseif ($status == 2) {
				if ($projinfo['status'] == 0) {
					$pstatus = 1;
				} elseif ($projinfo['status'] == 2) {
					$pstatus = 3;
				} else {
					$pstatus = $projinfo['status'];
				}
				M('project')->where('id='.$reinfo['proj_id'])->setField('status',$pstatus);
			}
			$res = $rei->where('id='.$id)->setField('status',$status);
			if ($res === false) {
				$this->error('保存失败！',U('Finance/billing'));
			} else {
				$this->success('保存成功',U('Finance/billing'));
			}
		} else {
			$appfee = M('fee_application')->where(array('proj_id'=>$reinfo['proj_id'],'status'=>3))->find();
			$this->projinfo = $projinfo;
			$this->appfee = $appfee;
			$this->reinfo = $reinfo;
			$this->display();
		}
	}
	
	public function endDetails() {
		$id = I('id');
		$lot = M('lot');
		$project = M('project');
		$projinfo = $project
					->join('left join noah_user user on noah_project.supervisor=user.Id')
					->field('noah_project.*,user.username')
					->where('noah_project.id='.$id)
					->find();
		if (IS_POST) {
			$data['leader_check'] = I('post.leader_check','intval');
			$data['treasurer_check'] = I('post.treasurer_check','intval');
			if ($data['leader_check'] == 2 || $data['treasurer_check'] == 2) {
				$msg['from']	= session('uid');
				$msg['to']		= $projinfo['supervisor'];
				$msg['title']	= $projinfo['name'].'完结结算未通过';
				$msg['content']= I('post.leader_opinion').I('post.treasurer_opinion');
				$msg['sendtime']= time();
				M('message')->add($msg);
			}
			$res = $project->where('id='.$id)->save($data);
			if ($res === false) {
				$this->error('保存失败！',U('Finance/endCheck'));
			} else {
				$this->success('保存成功！',U('Finance/endCheck'));
			}
		} else {
			$lotinfo = $lot->where('proj_id='.$id)->select();
			$this->lotinfo = $lotinfo;
			$this->projinfo = $projinfo;
			$this->display();
		}
	}
	
	public function tst() {
		//$data = M('menu')->select();
		$this->menu = $this->menuList();
		$this->pos = $this->getPos(31);
		$this->display();
	}
}