<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends CommonController {
    public function _initialize(){
        parent::_initialize();
    }

    //后台下单
    public function add(){
        $mem = M('member');
    	if (IS_POST) {
    		$oinfo = I('oinfo');
    		$oinfo['add_time'] = strtotime($oinfo['add_time']);
    		$cai = I('cai');
            $order = M('order');
            $cai_sku = M('cai_sku');
            $consinfo = $this->clear($cai);
            $oinfo['totalfee'] = $consinfo['price'];
            $oinfo['peisong'] = $consinfo['peisong'];
            //扣减金额及次数
            $meminfo = $mem->where(array('id'=>$oinfo['userid']))->field('deliverytimes,usedtimes,depositmoney,usedmoney')->find();
            $oinfo['synums'] = $meminfo['deliverytimes'] - $meminfo['usedtimes'] - $consinfo['peisong'];
            $oinfo['ymoney'] = $meminfo['depositmoney'] - $meminfo['usedmoney'] - $consinfo['price'];
            $meminfo['usedtimes'] += $consinfo['peisong'];
            $meminfo['usedmoney'] += $consinfo['price'];
            $mem->where(array('id'=>$oinfo['userid']))->save($meminfo);
            //数据库写入操作
    		$order->startTrans();
    		$order_no = M('orderinfo')->add($oinfo);
    		if ($order_no) {
    			foreach ($cai as $key=>$val) {
    				if ($val<1) {continue;}
    				$data['order_no'] = $order_no;
    				$data['sku_id'] = $key;
    				$data['count'] = $val;
    				$res = $cai_sku->where('sku_id='.$key.' and stock>='.$val)->setDec('stock',$val);
    				if (!$res) {
    					$flag = 1;
    				}
    				$order->add($data);
    				unset($data);
    			}
    		}
    		if ($flag) {
    			$order->rollback();
    			$this->error('保存失败!',U('Order/noorder'));
    		} else {
    			$order->commit();
    			$this->success('保存成功!',U('Order/noorder'));
    		}
    	} else {
	    	$id = I('uid');
            //获取上一笔订单
            $maxid = M('orderinfo')->where('userid='.$id)->getField('max(id)');
            $this->lastorder = $mem->table('noah_order o')
                            ->join('left join noah_cai_sku sku on o.sku_id=sku.sku_id')
                            ->join('left join noah_cais cais on sku.cai_id=cais.id')
                            ->field('cais.name,sku.sku_name,o.count')
                            ->where('o.order_no='.$maxid)
                            ->select();
	    	$this->meminfo = $mem->where(array('id'=>$id,'is_del'=>0))->find();
	    	$this->caitype = M('caitype')->field('id,name')->select();
	    	//获取各个分类下的菜品信息
	    	foreach ($this->caitype as $key => $value) {
	    		$caisinfo[$value['id']] = $this->getCaisInfo($value['id']);
	    	}
	    	$this->caisinfo = $caisinfo;
	    	$veh = $this->foodcat('vehicle');
	        $this->assign('veh',$veh);
	        $this->packaging = $this->foodcat('packaging');
	    	$this->display();
    	}
    }
    public function edit(){
        $id = I('oid');
        $cai = I('cai');
        $orderinfo = M('orderinfo');
        $mem = M('member');
        if (IS_POST) {
            if ($this->cancelOrder($id,false)) {
                $oinfo = I('oinfo');
                $oinfo['add_time'] = strtotime($oinfo['add_time']);
                $order = M('order');
                $cai_sku = M('cai_sku');
                $consinfo = $this->clear($cai);
                $oinfo['totalfee'] = $consinfo['price'];
                $oinfo['peisong'] = $consinfo['peisong'];
                //扣减金额及次数
                $meminfo = $mem->where(array('id'=>$oinfo['userid']))->field('deliverytimes,usedtimes,depositmoney,usedmoney')->find();
                $oinfo['synums'] = $meminfo['deliverytimes'] - $meminfo['usedtimes'] - $consinfo['peisong'];
                $oinfo['ymoney'] = $meminfo['depositmoney'] - $meminfo['usedmoney'] - $consinfo['price'];
                $meminfo['usedtimes'] += $consinfo['peisong'];
                $meminfo['usedmoney'] += $consinfo['price'];
                $mem->where(array('id'=>$oinfo['userid']))->save($meminfo);
                //数据库写入操作
                $order->startTrans();
                $order_no = M('orderinfo')->where('id='.$id)->save($oinfo);
                $delres = $order->where('order_no='.$id)->delete();
                if ($order_no !== false && $delres !== false) {
                    foreach ($cai as $key=>$val) {
                        if ($val<1) {continue;}
                        $data['order_no'] = $id;
                        $data['sku_id'] = $key;
                        $data['count'] = $val;
                        $res = $cai_sku->where('sku_id='.$key.' and stock>='.$val)->setDec('stock',$val);
                        if (!$res) {
                            $flag = 1;
                        }
                        $order->add($data);
                        unset($data);
                    }
                }
                if ($flag) {
                    $order->rollback();
                    $this->error('保存失败!',U('Order/index'));
                } else {
                    $order->commit();
                    $this->success('保存成功!',U('Order/index'));
                }
            }
        } else {
            $oinfo = $orderinfo->where('id='.$id)->find();
            $this->assign('oinfo',$oinfo);
            $this->meminfo = $mem->where(array('id'=>$oinfo['userid'],'is_del'=>0))->find();
            $this->caitype = M('caitype')->field('id,name')->select();
            //获取各个分类下的菜品信息
            foreach ($this->caitype as $key => $value) {
                $caisinfo[$value['id']] = $this->getCaisInfo($value['id']);
            }
            $this->caisinfo = $caisinfo;
            //获取订单菜品数量信息
            $this->ordata = M('order')->where('order_no='.$id)->getField('sku_id,count');
            //获取当前订单
            $this->currentorder = $mem->table('noah_order o')
                            ->join('left join noah_cai_sku sku on o.sku_id=sku.sku_id')
                            ->join('left join noah_cais cais on sku.cai_id=cais.id')
                            ->field('cais.name,sku.sku_name,o.count')
                            ->where('o.order_no='.$id)
                            ->select();
            $veh = $this->foodcat('vehicle');
            $this->assign('veh',$veh);
            $this->packaging = $this->foodcat('packaging');
            $this->display();
        }
        
    }

    //未下单用户
    public function noorder(){
    	$member = M('member');
    	$veh = $this->foodcat('vehicle');
        $this->assign('veh',$veh);
        $nowpage = I('p')?I('p'):1;
        $map['is_del'] = 0;
        if (!empty($_GET['ordertime'])) {
        	$time = strtotime($_GET['ordertime']);
        	$date = date('w',$time);
        	$map['ordertime'] = $_GET['ordertime'];
        } else {
        	$date = date('w');
        	$map['ordertime'] = date('Y-m-d');
        }
        $week = getDeliveryWeek($date);
        
        $str=" and peisongtime like '%".$week."%'";
        if(!empty($_GET['shouhuoname'])){
            $str.=(" and shouhuoname like '%".$_GET['shouhuoname']."%'");
            $map['shouhuoname'] = $_GET['shouhuoname'];
        }
        if(!empty($_GET['phone'])){
           $str.=(" and phone='".$_GET['phone']."'");
           $map['phone'] = $_GET['phone'];
        }
        if(!empty($_GET['diancaitype'])){
           $str.=(" and diancaitype='".$_GET['diancaitype']."'");
           $map['diancaitype'] = $_GET['diancaitype'];
        }
        if(!empty($_GET['vehicle'])){
           $str.=(" and vehicle='".$_GET['vehicle']."'");
           $map['vehicle'] = $_GET['vehicle'];
        }
        $this->member = $member->where('is_del=0'.$str)->order('id desc')->page($nowpage.',20')->select();
        $count = $member->where('is_del=0'.$str)->count();
        $Page = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        foreach($map as $key=>$val) {
            $Page->parameter[$key] = urlencode($val);
        }
        $Page->lastSuffix=false;
        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('map',$map);
    	$this->display();
    }

    //订单列表页
    public function catalog(){
        $orderinfo = M('orderinfo');
        $nowpage = I('p')?I('p'):1;
        $map['is_del'] = 0;
        $add_time = I('add_time');
        if (!empty($add_time)) {
            $starttime = strtotime(I('add_time'));
            $endtime   = $starttime+86400;
            $map['add_time'] = $add_time;
        } else {
            $starttime = strtotime(date('Y-m-d'));
            $endtime   = $starttime+86400;
            $map['add_time'] = date('Y-m-d');
        }
        $str = ' and oinfo.add_time>=\''.$starttime.'\' and oinfo.add_time<\''.$endtime.'\'';
        $shouhuoname = I('shouhuoname');
        if (!empty($shouhuoname)) {
            $str .= ' and mem.shouhuoname=\''.I('shouhuoname').'\'';
            $map['shouhuoname'] = I('shouhuoname');
        }
        $phone = I('phone');
        if (!empty($phone)) {
            $str .= ' and oinfo.phone=\''.I('phone').'\'';
            $map['phone'] = I('phone');
        }
        $vehicle = I('phone');
        if (!empty($vehicle)) {
            $str .= ' and oinfo.vehicle=\''.I('vehicle').'\'';
            $map['vehicle'] = I('vehicle');
        }
        $cai_name = I('cai_name');
        if (!empty($cai_name)) {
            $cai_name = $map['cai_name'] = I('cai_name');
            $cai_id = M('cais')->where(array('name'=>$cai_name))->getField('id');
            $order_no = $orderinfo->table('noah_order o')
                                    ->join('left join noah_orderinfo oinfo on o.order_no=oinfo.id')
                                    ->join('left join noah_cai_sku sku on o.sku_id=sku.sku_id')
                                    ->join('left join noah_member mem on oinfo.userid=mem.id')
                                    ->field('o.order_no')
                                    ->where('sku.cai_id='.$cai_id.$str)
                                    ->select();
            $str.=" and oinfo.id in(";
            foreach ($order_no as $key => $value) {
                $str.=$value['order_no'].',';
            }
            $str = rtrim($str,',');
            $str.=")";
        }
        $count = $orderinfo->table('noah_orderinfo oinfo')
                            ->join('left join noah_member mem on oinfo.userid=mem.id')
                            ->where('oinfo.is_del=0'.$str)->count();
        $this->orderlist = $orderinfo->table('noah_orderinfo oinfo')
                            ->join('left join noah_member mem on oinfo.userid=mem.id')
                            ->field('oinfo.id,oinfo.address,oinfo.phone,oinfo.remark,mem.card_num,mem.shouhuoname,mem.membername')
                            ->where('oinfo.is_del=0'.$str)
                            ->page($nowpage.',20')
                            ->select();
        $Page = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        foreach($map as $key=>$val) {
            $Page->parameter[$key] = urlencode($val);
        }
        $Page->lastSuffix=false;
        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('map',$map);
        $veh = $this->foodcat('vehicle');
        $this->assign('veh',$veh);
        $this->display();
    }

    //取消下单
    public function cancel(){
        $id = I('id');
        if ($this->cancelOrder($id)) {
            $this->success('取消订单成功！',U('Order/index'));
        } else {
            $this->error('取消订单失败！',U('Order/index'));
        }
    }

    //计算用户订单消耗次数和金额
    //参数为菜品数组，key为sku_id，value为数量
    private function clear($cai){
        $good = M('cais');
        //计算菜品重量及消费金额
        $data['price'] = 0;
        $data['weight'] = 0;
        foreach ($cai as $key=>$val) {
            if ($val<1) {continue;}
            $cinfo = $good->table('noah_cai_sku sku')
            ->join('noah_caitype caitype on sku.ct_id=caitype.id')
            ->field('caitype.is_toll,sku.weight,sku.price')
            ->where('sku.sku_id='.$key)
            ->find();
            if ($cinfo['is_toll']) {
                $data['price'] += $cinfo['price']*$val;
            } else {
                $data['weight'] += $cinfo['weight']*$val;
            }
        }
        if ($data['weight'] || $data['price']<200) {
            $data['peisong'] = 1;
        } else {
            $data['peisong'] = 0;
        }
        return $data;
    }

    //取消订单
    private function cancelOrder($oid, $is_del = true){
        $mem = M('member');
        $orderinfo = M('orderinfo');
        $order = M('order');
        $cai_sku = M('cai_sku');
        //返还金额和次数
        $corder = $orderinfo->where('id='.$oid)->find();
        $meminfo = $mem->where('id='.$corder['userid'])->find();
        $meminfo['usedmoney'] -= $corder['totalfee'];
        $meminfo['usedtimes'] -= $corder['peisong'];
        $r1 = $mem->where('id='.$corder['userid'])->save($meminfo);
        //返还库存
        $cainum = $order->where('order_no='.$oid)->select();
        foreach($cainum as $val){
            $flag = $cai_sku->where('sku_id='.$val['sku_id'])->setInc('stock',$val['count']);
            if ($flag === false) {
                $r2 = false;
            }
        }
        if ($r1 === false || $r2 === false) {
            return false;
        } else {
            if ($is_del) {
                $orderinfo->where('id='.$oid)->setField('is_del',1);
            }
            return true;
        }
    }
}