<?php
namespace Admin\Controller;
use Think\Controller;
class MemberController extends CommonController {
    public function _initialize(){
        parent::_initialize();
         if ($this->isLogin()) {
            $this->checkRule();
        }  
    }

    //菜品类别管理
    public function memberlist(){
        $member=M('member');
        $str="";
        $membername = I('get.membername');
        if(!empty($membername)){
            $str.=(" and membername like '%".$membername."%'");
        }
        $vehicle = I('get.vehicle');
        if(!empty($vehicle)){
           $str.=(" and vehicle like '%".$vehicle."%'");
        }
        $veh = $this->foodcat('vehicle');
        $this->assign('veh',$veh);
        $this->packaging = $this->foodcat('packaging');
        $nowpage = $_GET['p']?$_GET['p']:1;
        $map['is_del'] = 0;
       
       	$list= $member ->where('is_del=0'.$str)->order('id desc')->page($nowpage.',20')->select();
        $this->assign('list',$list);// 赋值数据集

        $count=$member ->where('is_del=0'.$str)->count();// 查询满足要求的总记录数

        $Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        foreach($map as $key=>$val) {
            $Page->parameter[$key] = urlencode($val);
        }
        $Page->lastSuffix=false;
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('map',$map);
        $this->display(); // 输出模板



       
    }

    //添加菜品类别
    public function add_member(){
        $member = M('member');
        $veh = $this->foodcat('vehicle');
        $ct = $this->foodcat('cardtype');
        $pg = $this->foodcat('packaging');
        $this->assign('veh',$veh);
        $this->assign('ct',$ct);
        $this->assign('pg',$pg);
        if (IS_POST) {
            $r_ary['name'] = I('name');
            $r_ary['membername'] = I('membername');
            $r_ary['shouhuoname'] = I('shouhuoname');
            $r_ary['is_sms']=I('is_sms');
            $r_ary['phone'] = I('phone');
            $r_ary['phonetwo'] = I('phonetwo');
            $r_ary['address'] = I('address');
            $r_ary['diancaitype']=I('diancaitype');
            $r_ary['regtime'] = I('regtime');
            $r_ary['peisongtime'] = I('peisongtime');
            $r_ary['peisongweight'] = I('peisongweight');
            $r_ary['vehicle'] = I('vehicle');
            $r_ary['packaging'] = I('packaging');
            $r_ary['password']=md5(I('password'));
            $r_ary['depositmoney']=I('depositmoney');
            $r_ary['deliverytimes']=I('deliverytimes');
            $r_ary['card_num']=I('card_num');
            $m_res = $member->add($r_ary);
            $this->recordIt();
            if ($m_res) {
                $this->success('添加成功!',U('Member/memberlist'));
            } else {
                $this->error('添加失败!',U('Member/add_member'));
            }
        } else {
            $this->member = $member->field('id')->select();
        }
        $this->display();
    }

    //修改菜品类别
    public function update_member(){
        $member = M('member');
        $veh = $this->foodcat('vehicle');
        $ct = $this->foodcat('cardtype');
        $pg = $this->foodcat('packaging');
        $this->assign('veh',$veh);
        $this->assign('ct',$ct);
        $this->assign('pg',$pg);
        $member = M('member');
        $id = I('id');
        if (IS_POST) {
            $r_ary['membername'] = I('membername');
            $r_ary['shouhuoname'] = I('shouhuoname');
            $r_ary['is_sms']=I('is_sms');
            $r_ary['phone'] = I('phone');
            $r_ary['phonetwo'] = I('phonetwo');
            $r_ary['address'] = I('address');
            $r_ary['diancaitype']=I('diancaitype');
            $r_ary['regtime'] = I('regtime');
            $r_ary['peisongtime'] = I('peisongtime');
            $r_ary['peisongweight'] = I('peisongweight');
            $r_ary['vehicle'] = I('vehicle');
            $r_ary['packaging'] = I('packaging');
            $r_ary['password']=md5(I('password'));
            $r_ary['depositmoney']=I('depositmoney');
            $r_ary['deliverytimes']=I('deliverytimes');
            $r_ary['card_num']=I('card_num');
            $r_res = M('member')->where(array('id'=>$id))->save($r_ary);
            $this->recordIt();
            if ($r_res === false) {
                $this->error('保存失败!',U('Member/memberlist'));
            } else {
                $this->success('保存成功!',U('Member/memberlist'));
            }
        } else {
            $this->member = $member->field('id')->select();
            $this->memberlist = $member->where(array('id'=>$id))->find();
            $this->display();
        }
    }

    //删除菜品类别
    public function delete_member(){
        $memberlist = M('member');
        $id = I('id');
        $r_ary['is_del'] = 1;
        $r_res = M('member')->where(array('id'=>$id))->save($r_ary);
        $this->recordIt();
        if ($r_res) {
            $this->success('删除成功!',U('Member/memberlist'));
        } else {
            $this->error('删除失败!',U('Member/memberlist'));
        }
    }

    //卡片管理搜索功能ajax交互
    public function ajax_search(){
        $mem = M('member');
        $membername = I('post.membername');
        if(!empty($membername)){
            $str.=(" and membername like '%".I('membername')."%'");
        }
        $phone = I('post.phone');
        if(!empty($phone)){
            $str.=(" and phone like '%".I('phone')."%'");
        }
        $memlist = $mem->where('is_del=0'.$str)->field('id,membername,phone,address')->select();
        echo json_encode($memlist);
    }
}