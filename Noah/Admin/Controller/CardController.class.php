<?php
namespace Admin\Controller;
use Think\Controller;
class CardController extends CommonController {
    public function _initialize(){
        parent::_initialize();
    }

    public function _after_update(){
        $this->recordIt();
    }

    public function index(){
        $card = M('card'); // 实例化User对象
        $nowpage = $_GET['p']?$_GET['p']:1;
        $map['is_del'] = 0;
        $str = ' is_del = 0';
        if ($_GET['cardnum']) {
            $map['cardnum'] = $_GET['cardnum'];
            $str .= ' and cardnum like \'%'.$map['cardnum'].'%\'';
        }
        if ($_GET['cardname']) {
            $map['cardname'] = $_GET['cardname'];
            $str .= ' and cardname like \'%'.$map['cardname'].'%\'';
        }
        if ($_GET['status']) {
            $map['status'] = $_GET['status'];
            $str .= ' and cardname ='.$map['cardname'];
        }
        $list = $card->where($str)->order('id desc')->page($nowpage.',20')->select();
        $this->assign('list',$list);// 赋值数据集
        $count      = $card->where($str)->count();// 查询满足要求的总记录数
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

    public function add_card(){
        $card = M('card');
        $cardinfo = I('card');
        if (IS_POST) {
            $res = $card->add($cardinfo);
            if ($res) {
                $this->success('添加成功!',U('Card/index')); 
           } else {
                $this->error('添加失败!',U('Card/add_card'));
           }
            
        } else {
            $this->display();
        }
    }
}