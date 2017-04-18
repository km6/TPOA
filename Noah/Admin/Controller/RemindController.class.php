<?php
namespace Admin\Controller;
use Think\Controller;
class RemindController extends CommonController {
	public function _initialize(){
		parent::_initialize();
	}
	
	/*
	 * @author kemao_000
	 * 项目数据汇总
	 */
	public function index() {
		 if ($this->groups[0]['group_id'] == 2) {
		 	$uid		= session('uid');
		 	$project	= M('project');
		 	$today		= strtotime(date('Y-m-d'));
		 	$this->olist = $project->where(array('supervisor'=>$uid,'opening_date'=>$today))->select();
		 	$this->elist = $project->where(array('supervisor'=>$uid,'extract_date'=>$today))->select();
		 	$this->clist = $project->where(array('supervisor'=>$uid,'closing_date'=>$today))->select();
		 	$this->complist = $project->where(array('supervisor'=>$uid,'status'=>array('IN','0,1')))->select();
		 	$this->reimlist = $project->where(array('supervisor'=>$uid,'status'=>array('IN','0,2')))->select();
		 	$this->display();
		 } elseif ($this->groups[0]['group_id'] == 4) {
		 	$uid = session('uid');
		 	//待审核费用申请
		 	$applist = M('fee_application')->alias('app')
		 				->join('noah_project project on app.proj_id=project.id')
		 				->where('project.approver='.$uid.' and app.status=1')
		 				->field('app.*,project.project_sn,project.name')
		 				->select();
		 	//待审核已完结项目
		 	$projlist = M('project')->alias('project')
		 				->where('project.status=3 and leader_check=0')
		 				->select();
		 	$this->projlist = $projlist;
		 	$this->applist = $applist;
		 	$this->display('index_m');
		 } elseif ($this->groups[0]['group_id'] == 3) {
		 	//待审核已完结项目
		 	$projlist = M('project')->alias('project')
					 	->where('project.status=3 and treasurer_check=0')
					 	->select();
			$this->projlist = $projlist;
			$this->display('index_f');	
		 }
		
	}
	
// 	public function testcsv() {
// 		$list = M('project')->field('id,name,project_sn')->select();
// 		$csv_title=array('id','name','project_sn');
// 		put_csv($list,$csv_title);
// 	}
}