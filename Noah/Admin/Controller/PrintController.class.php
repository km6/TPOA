<?php
namespace Admin\Controller;
use Think\Controller;
class PrintController extends CommonController {
    public function _initialize(){
        parent::_initialize();
    }

    public function recovery(){
    	$is_print = I('get.print');
    	$date = I('get.date');
    	if ($date) {
    		$str = 'oinfo.add_time='.strtotime($date);
    	} else {
    		$str = 'oinfo.add_time='.strtotime(date('Y-m-d'));
    	}
    	
    	$vehicle = I('get.vehicle');
    	if ($vehicle) {
    		$str.= ' and oinfo.vehicle in ('.$vehicle.')';
    	}
    	$db = M();
    	$data = $db	->table('noah_order ord')
		    		->join('left join noah_orderinfo oinfo on ord.order_no = oinfo.id')
		    		->join('left join noah_cai_sku sku on ord.sku_id = sku.sku_id')
		    		->join('left join noah_cais cais on sku.cai_id = cais.id')
		    		->join('left join noah_caitype caitype on cais.ctid = caitype.id')
		    		->field('ord.sku_id,ord.count,sku.sku_name,cais.name,caitype.is_toll')
		    		->where($str)
		    		->order('cais.sort desc,sku.sku_id desc')
		    		->select();
		foreach ($data as $val) {
			$recdata[$val['is_toll']][$val['sku_id']]['count'] +=$val['count'];
			$recdata[$val['is_toll']][$val['sku_id']]['name'] = $val['name'].$val['sku_name'];
		}
		$this->count = count($recdata[0]);
		$this->count1 = count($recdata[1]);
		$this->recdata = $recdata;
		if ($is_print) {
			$this->display('precovery');
		} else {
			$this->display();
		}
    }
}