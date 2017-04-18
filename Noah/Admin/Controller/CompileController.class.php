<?php
namespace Admin\Controller;
use Think\Controller;
class CompileController extends CommonController {
	public function _initialize(){
		parent::_initialize();
	}
	
	/*
	 * @author kemao_000
	 * 项目汇编列表页，显示需完成汇编的项目
	 */
	public  function index() {
		$project = M('project');
		$name = I('get.name');
		$name = urldecode($name);
		//$str = 'supervisor='.session('uid').' ';
		if(!empty($name)){
			$str.=("name like '%".$name."%' or project_sn like '%".$name."%'");
			$map['name'] = $name;
		}
		$nowpage = $_GET['p']?$_GET['p']:1;
		$this->list = $project->alias('proj')
					->join('left join noah_user user on proj.supervisor=user.Id')
					->field('proj.id,proj.name,proj.project_sn,proj.opening_date,proj.status,user.username')
					->where($str)->order('proj.id desc')->page($nowpage.',20')->select();
		$count=$project->join('left join noah_user user on noah_project.supervisor=user.Id')
					->where($str)->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		foreach($map as $key=>$val) {
			$Page->parameter[$key] = urlencode($val);
		}
		$Page->lastSuffix=false;
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('map',$map);
		$this->assign('name',$name);
		//$this->projStatus = $this->getOption('projStatus');
		$this->display();
	}
	
	/*
	 * @author kemao_000
	 * 汇编管理员完成汇编操作
	 */
	public function complete() {
		$proj_id = I('post.proj_id');
		$project = M('project');
		$projectinfo = $project->where('id='.$proj_id)->find();
		if ($projectinfo['status'] == 2 || $projectinfo['status'] == 3){
			$this->error('该项目已完成汇编！',U('Compile/index'));
		} else {
			if ($projectinfo['status'] == 0) {
				$status = 2;
			} elseif ($projectinfo['status'] == 1) {
				$status = 3;
			} else {
				$status = $projectinfo['status'];
			}
			$res = $project->where('id='.$proj_id)->setField('status',$status);
			if ($res === false) {
				$this->error('操作失败！',U('Compile/index'));
			} else {
				$this->success('操作成功！',U('Compile/index'));
			}
		}
	}
}