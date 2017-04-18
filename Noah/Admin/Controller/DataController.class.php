<?php
namespace Admin\Controller;
use Think\Controller;
class DataController extends CommonController {
	public function _initialize(){
		parent::_initialize();
	}
	
	/*
	 * @author kemao_000
	 * 项目数据汇总
	 */
	public function projectGather() {
		if (I('get.start_date') && I('get.end_date')) {
			$starttime 	= strtotime(I('get.start_date'));
			$endtime 	= strtotime(I('get.end_date'));
			$where = 'project.opening_date>='.$starttime.' and project.opening_date<='.$endtime;
		}
		$lot = M('lot');
		$projStatus = $this->getOption('projStatus');
		$info = $lot->alias('lot')
				->join('noah_project project on lot.proj_id=project.id')
				->join('noah_user user on project.supervisor=user.Id')
				->join('noah_reimbursement rei on lot.proj_id=rei.proj_id')
				->where($where)
				->field('project.id,project.project_sn,project.name,user.username,FROM_UNIXTIME(project.opening_date,\'%Y-%m-%d\') as opening_date,lot.name as lotname,lot.tender_fee,lot.bid_amount,lot.service_fee,lot.s_bidder,rei.evaluation_fee,rei.venue_fee,rei.travel_fee,project.status')
				->select();
		foreach ($info as $key=>$val) {
			$info[$key]['status'] = $projStatus[$val['status']];
			if ($val['id'] == $info[$key-1]['id']) {
				$info[$key]['id'] = '';
				$info[$key]['project_sn'] = '';
				$info[$key]['name'] = '';
				$info[$key]['username'] = '';
				$info[$key]['opening_date'] = '';
				$info[$key]['status'] = '';
			}
		}
		if (I('get.put')) {
			$title = array('序号','项目编号','项目名称','项目负责人','开标日期','标段号','标书费','中标金额','服务费','中标单位名称','评标费','场地费','出差费','项目完结情况');
			put_csv($info, $title, $name='项目数据汇总');
		}
		$this->info = $info;
		$this->projStatus = $projStatus;
		$this->display();
	}
}



