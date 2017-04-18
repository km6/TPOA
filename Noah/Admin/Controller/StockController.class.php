<?php
namespace Admin\Controller;
use Think\Controller;
class StockController extends CommonController {
	public function _initialize(){
		parent::_initialize();
	}
	
	public function info() {
		$items = M('item')->field('name,stock,unit')->select();
		$this->items = $items;
		$this->display();
	}
	
	public function additem() {
		if (IS_POST) {
			$data['name'] = I('post.name');
			$data['unit'] = I('post.unit');
			$res = M('item')->add($data);
			if ($res) {
				$this->success('条目添加成功！');
			} else {
				$this->error('条目添加失败！');
			}
		} else {
			$this->display();
		}
	}
	
	public function in() {
		$item = M('item');
		if (IS_POST) {
			$id = I('post.item_id');
			$stock = I('post.stock');
			$res = $item->where(array('id'=>$id))->setInc('stock',$stock);
			if ($res === false) {
				$this->error('库存添加失败！');
			} else {
				$this->success('库存添加成功');
			}
		} else {
			$itemlist = $item->field('id,name')->select();
			$this->itemlist = $itemlist;
			$this->display();
		}
	}

	public function out() {
		$item = M('item');
		if (IS_POST) {
			$id = I('post.item_id');
			$stock = I('post.stock');
			$res = $item->where(array('id'=>$id))->setDec('stock',$stock);
			if ($res === false) {
				$this->error('库存修改失败！');
			} else {
				$this->success('库存修改成功');
			}
		} else {
			$itemlist = $item->field('id,name')->select();
			$this->itemlist = $itemlist;
			$this->display();
		}
	}
}