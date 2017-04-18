<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * @author kemao_000
 * @date 2016年2月17日 上午10:35:45  
 *
 */
class SystemController extends CommonController {
    public function _initialize(){
        parent::_initialize();
    }

    //菜单管理
    public function menu(){
    	$this->menu = M('menu')->select();
    	$this->display();
    }

    /*
     * @author kemao_000
     * 添加子菜单
     */
    public function add_menu(){
    	$menu = M('menu');
    	if (IS_POST) {
    		$r_ary['title'] = $m_ary['name'] = I('name');
    		$m_ary['parent_id'] = I('parent_id') == 1? 0:I('parent_id');
    		$r_ary['name'] = $m_ary['url'] = I('url');
    		$r_ary['status'] = 1;
    		$r_ary['type'] = 1;
    		$r_res = M('auth_rule')->add($r_ary);
    		$m_ary['rule_id'] = $r_res;
            $m_ary['is_show'] = I('is_show');
    		$m_res = $menu->add($m_ary);
    		if ($m_res && $r_res) {
    			$this->success('添加成功!',U('System/menu'));
    		} else {
    			$this->error('添加失败!',U('System/add_menu'));
    		}
    	} else {
    		$menuList = $this->getNodeList();
    		foreach ($menuList as $key=>$val) {
    			if ($val['url'] == 'Admin/Admin/index') {
    				unset($menuList[$key]);
    				continue;
    			}
    			$str = '|--';
    			for ($i=0;$i<$val['count'];$i++) {
    				$str.='----';
    			}
    			$menuList[$key]['name'] = $str.$val['name'];
    		}
    		$this->menu = $menuList;
            $this->display();
    	}
    }

    //修改菜单
    public function update_menu(){
    	$menu = M('menu');
    	$id = I('id');
    	if (IS_POST) {
    		$rule_id = $menu->where(array('Id'=>$id))->getField('rule_id');
    		$r_ary['title'] = $m_ary['name'] = I('name');
    		$m_ary['parent_id'] = I('parent_id') == 1? 0:I('parent_id');
    		$r_ary['name'] = $m_ary['url'] = I('url');
            $m_ary['is_show'] = I('is_show');
    		$r_res = M('auth_rule')->where(array('id'=>$rule_id))->save($r_ary);
    		$m_res = $menu->where(array('Id'=>$id))->save($m_ary);
    		if ($m_res == false && $r_res == false) {
    			$this->error('保存失败!',U('System/add_menu'));
    		} else {
    			$this->success('保存成功!',U('System/menu'));
    		}
    	} else {
    		$menuList = $this->getNodeList();
    		foreach ($menuList as $key=>$val) {
    			if ($val['url'] == 'Admin/Admin/index') {
    				unset($menuList[$key]);
    				continue;
    			}
    			$str = '|--';
    			for ($i=0;$i<$val['count'];$i++) {
    				$str.='----';
    			}
    			$menuList[$key]['name'] = $str.$val['name'];
    		}
    		$this->menu = $menuList;
    		$this->menuinfo = $menu->where(array('Id'=>$id))->find();
    		$this->display();
    	}
    }

    //删除菜单
    public function delete_menu(){
    	$menu = M('menu');
    	$id = I('id');
    	$rule_id = $menu->where(array('Id'=>$id))->getField('rule_id');
    	$r_res = M('auth_rule')->where(array('id'=>$rule_id))->delete();
    	$m_res = $menu->where(array('Id'=>$id))->delete();
    	if ($m_res && $r_res) {
			$this->success('删除成功!',U('System/menu'));
		} else {
			$this->error('删除失败!',U('System/menu'));
		}
    }

    //管理员管理
    public function user(){

    }
}