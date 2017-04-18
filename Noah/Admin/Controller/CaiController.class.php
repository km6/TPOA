<?php
namespace Admin\Controller;
use Think\Controller;
class CaiController extends CommonController {
    public function _initialize(){
        parent::_initialize();
       if ($this->isLogin()) {
            $this->checkRule();
        }  
    }

    //菜品类别管理
    public function caitype(){
        $this->caitype = M('caitype')->select();
        $this->display();
    }

    //添加菜品类别
    public function add_caitype(){
        $caitype = M('caitype');
        if (IS_POST) {
            $r_ary['name'] = I('name');
            $r_ary['extand'] = I('extand');
            $r_ary['sort'] = I('sort');
            $r_ary['is_toll']=I('is_toll');
            $m_res = $caitype->add($r_ary);
            if ($m_res) {
                $this->success('添加成功!',U('Cai/caitype'));
            } else {
                $this->error('添加失败!',U('Cai/add_caitype'));
            }
        } else {
            $this->caitype = $caitype->field('id,name')->select();
        }
        $this->display();
    }

    //修改菜品类别
    public function update_caitype(){
        $caitype = M('caitype');
        $id = I('id');
        if (IS_POST) {
            $r_ary['name'] = I('name');
            $r_ary['extand'] = I('extand');
            $r_ary['sort'] = I('sort');
            $r_ary['is_toll']=I('is_toll');
            $r_res = M('caitype')->where(array('id'=>$id))->save($r_ary);
            if ($r_res === false) {
                $this->error('保存失败!',U('Cai/caitype'));
            } else {
                $this->success('保存成功!',U('Cai/caitype'));
            }
        } else {
            $this->caitype = $caitype->field('id,name')->select();
            $this->menuinfo = $caitype->where(array('id'=>$id))->find();
            $this->display();
        }
    }

    //删除菜品类别
    public function delete_caitype(){
        $caitype = M('caitype');
        $id = I('id');
        $m_res = $caitype->where(array('id'=>$id))->delete();
        if ($m_res) {
            $this->success('删除成功!',U('Cai/caitype'));
        } else {
            $this->error('删除失败!',U('Cai/caitype'));
        }
    }


    //菜品管理
    public function cais(){
        $nowpage = $_GET['p']?$_GET['p']:1;
        $str="";
        if(!empty($_GET['name'])){
            $str.=(" and a.name like '%".$_GET['name']."%'");
            $map['name'] = $_GET['name'];
        }
        if(!empty($_GET['ctid'])){
           $str.=(" and b.name like '%".$_GET['ctid']."%'");
           $map['ctid'] = $_GET['ctid'];
        }

        $caitype=M('caitype');

       $list=M('')->table("noah_cais a")->join('left join noah_caitype b on a.ctid=b.id ')
                ->join('left join noah_cai_inventory c on a.id=c.cid ')
                ->field('a.id,a.name,a.price,a.weight,a.unit,a.frontsort,a.details,a.remark,b.name as ctid,c.inventory')
                ->where("1=1 ".$str)
                ->order('a.id desc')->page($nowpage.',20')
                ->select();
        $count = M('')->table("noah_cais a")->join('left join noah_caitype b on a.ctid=b.id ')
                ->join('left join noah_cai_inventory c on a.id=c.cid ')
                ->field('a.id,a.name,a.price,a.weight,a.unit,a.frontsort,a.details,a.remark,b.name as ctid,c.inventory')
                ->where("1=1 ".$str)
                ->count();
        $Page = new \Think\Page($count,20);
        foreach($map as $key=>$val) {
            $Page->parameter[$key] = urlencode($val);
        }
        $Page->lastSuffix=false;
        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('map',$map);
        $this->info=$list;
        $this->caitype = $caitype->field('id,name')->select();
        $this->display();
    }

    //添加菜品
    public function add_cais(){
        $cais = M('cais');
        $caitype=M('caitype');
        $cai_sku = M('cai_sku');
        if (IS_POST) {
            if (empty($_FILES)) {
                //可以不上传图片
            } else {
                $a = $this->img_upload();
                if ($a) {
                    $r_ary['imgurl'] = C('SHOP_UPLOAD_URL').$a['imgurl']['savepath'].$a['imgurl']['savename'];
                }
            }
            $r_ary['price'] = I('price');
            $r_ary['ctid'] = I('ctid');
            $r_ary['name'] = I('name');
            $r_ary['weight'] = I('weight');
            $r_ary['unit'] = I('unit');
            $r_ary['frontsort'] = I('frontsort');
            $r_ary['details'] = I('details');
            $r_ary['remark'] = I('remark');
            $r_ary['is_rec'] = I('is_rec');

            $r_res = M('cais')->add($r_ary);

            if ($r_res) {
                $cai_sku->startTrans();
                $sku = I('sku');
                $data['cai_id'] = $r_res;
                $data['ct_id'] = I('ctid');
                foreach ($sku['sku_name'] as $k=>$v){
                    $data['sku_name'] = $v;
                    $data['price'] = $sku['price'][$k];
                    $data['weight'] = $sku['weight'][$k];
                    $data['stock'] = $sku['stock'][$k];
                    $sku_res = $cai_sku->add($data);
                    if (!$sku_res) {
                        $flag = 1;
                    }
                }
                if ($flag) {
                    $cai_sku->rollback();
                } else {
                    $cai_sku->commit();
                }
            }

            // $m_ary['cid'] = $r_res;
            // $m_ary['inventory'] = 0;

            // $m_res = M('cai_inventory')->add($m_ary);

            if ($r_res && !$flag) {
                $this->success('添加成功!',U('Cai/cais'));
            } else {
                $this->error('添加失败!',U('Cai/add_cais'));
            }
        } else {
            $this->caitype = $caitype->field('id,name')->select();
            $this->display();
        }
    }



    //修改菜品
    public function update_cais(){
        $caitype = M('caitype');
        $cais = M('cais');
        $cai_sku = M('cai_sku');
        $id = I('id');
        if (IS_POST) {
            if (empty($_FILES['imgurl']['tmp_name'])) {
                //可以不上传图片
            } else {
                $a = $this->img_upload();
                if ($a) {
                    $r_ary['imgurl'] = C('SHOP_UPLOAD_URL').$a['imgurl']['savepath'].$a['imgurl']['savename'];
                }
            }
            $r_ary['price'] = I('price');
            $r_ary['ctid'] = I('ctid');
            $r_ary['name'] = I('name');
            $r_ary['weight'] = I('weight');
            $r_ary['unit'] = I('unit');
            $r_ary['frontsort'] = I('frontsort');
            $r_ary['details'] = I('details');
            $r_ary['remark'] = I('remark');
            $r_ary['is_rec'] = I('is_rec');
            $r_res = $cais->where(array('id'=>$id))->save($r_ary);

            $cai_sku->startTrans();
            $sku = I('sku');
            $data['ct_id'] = I('ctid');
            $data['cai_id'] = I('id');
            // foreach ($sku['sku_id'] as $k=>$v) {
            //     $data['sku_name'] = $sku['sku_name'][$k];
            //     $data['price'] = $sku['price'][$k];
            //     $data['weight'] = $sku['weight'][$k];
            //     $data['stock'] = $sku['stock'][$k];
            //     $sku_res = $cai_sku->where(array('sku_id'=>$v))->save($data);
            //     if ($sku_res === false) {
            //         $flag = 1;
            //     }
            // }
            foreach ($sku['sku_name'] as $k=>$v) {
                $data['sku_name'] = $v;
                $data['price'] = $sku['price'][$k];
                $data['weight'] = $sku['weight'][$k];
                $data['stock'] = $sku['stock'][$k];
                if ($sku['sku_id'][$k]) {
                    $sku_res = $cai_sku->where(array('sku_id'=>$sku['sku_id'][$k]))->save($data);
                } else {
                    $sku_res = $cai_sku->add($data);
                }
                if ($sku_res === false) {
                    $flag = 1;
                }
            }
            if ($r_res === false) {
                $cai_sku->rollback();
                $this->error('保存失败!',U('Cai/cais'));
            } else {
                $cai_sku->commit();
                $this->success('保存成功!',U('Cai/cais'));
            }
        } else {
            $this->caitype = $caitype->field('id,name')->select();
            $this->menuinfo = $cais->where(array('id'=>$id))->find();
            $this->caisku = $cai_sku->where(array('cai_id'=>$id))->select();
            $this->display();
        }
    }


    //删除菜品
    public function delete_cais(){
        $cais = M('cais');
        $id = I('id');
        $m_res = $cais->where(array('id'=>$id))->delete();
        if ($m_res) {
            $this->success('删除成功!',U('Cai/cais'));
        } else {
            $this->error('删除失败!',U('Cai/cais'));
        }
    }
    //进货
    public function stock_cais(){
      $id= $_POST['id'];
      $r_ary['inventory'] = $_POST['inventorydate'];
      $r_res = M('cai_inventory')->where(array('id'=>$id))->save($r_ary);
    }

    //库存管理
    public function stock(){
        if (IS_POST) {
            $cai = I('cai');
            $cai_sku = M('cai_sku');
            foreach ($cai as $key=>$val) {
                $res = $cai_sku->where('sku_id='.$key)->setField('stock',$val);
                if ($res === false) {
                    $flag = 1;
                }
            }
            if ($flag) {
                $this->error('更新失败！',U('Cai/stock'));
            } else {
                $this->success('更新成功！',U('Cai/stock'));
            }
        } else {
            $this->caitype = M('caitype')->field('id,name')->select();
            //获取各个分类下的菜品信息
            foreach ($this->caitype as $key => $value) {
                $caisinfo[$value['id']] = $this->getCaisInfo($value['id']);
            }
            $this->caisinfo = $caisinfo;
            $this->display();
        } 
    }

    //ajax删除菜品规格
    public function delSku(){
        $sku_id = I('post.sku_id');
        $cai_sku = M('cai_sku');
        $res = $cai_sku->where('sku_id='.$sku_id)->delete();
        echo json_encode($res);
    }
}