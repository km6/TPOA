<?php
namespace Admin\Controller;
use Think\Controller;
class LotController extends CommonController {
	public function _initialize(){
		parent::_initialize();
	}
	
	public function manage() {
		$proj = M('project');
		$lots = M('lot');
		$proj_id = I('get.proj_id');
		$this->proj_info = $proj->where('id='.$proj_id)->find();
		$this->lotlist = $lots->where('proj_id='.$proj_id)->select();
		if (IS_POST) {
			$data['proj_id'] = I('post.proj_id');
			$lotinfo = I('post.lot');
			foreach ($lotinfo['name'] as $key=>$val) {
				$data['name'] = $val;
				$data['s_bidder'] = $lotinfo['s_bidder'][$key];
				$data['bid_amount'] = $lotinfo['bid_amount'][$key];
				$data['tender_fee'] = $lotinfo['tender_fee'][$key];
				$data['service_fee'] = $lotinfo['service_fee'][$key];
				if ($lotinfo['id'][$key]) {
					$res = $lots->where('id='.$lotinfo['id'][$key])->save($data);
				} else {
					$res = $lots->add($data);
				}
				if ($res === false) {
					$flag = true;
				}
			}
			if ($flag) {
				$this->error('标段添加失败！', U('Lot/manage', array('proj_id'=>$data['proj_id'])));
			} else {
				$this->success('标段添加成功！', U('Lot/manage', array('proj_id'=>$data['proj_id'])));
			}
		} else {
			$this->display();
		}
	}
}