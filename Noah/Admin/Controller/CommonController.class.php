<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * @author kemao_000
 * @date 2016年2月17日 上午10:42:53  
 *
 */
class CommonController extends Controller {
    protected $_name = '';
    static public $nodes = array();
    public function _initialize () {
        $this->_name = strtolower(CONTROLLER_NAME);
        if ($this->isLogin()) {
            $this->groups = $this->checkRule();
        }
        $this->reminder();
        $this->msgreminder();
        $this->lmenu	= $this->menuList();
        $this->menuid	= $this->getMenuId();
        $this->postion	= $this->getPos($this->menuid);
        $this->topMenu  = $this->getTopMenu($this->menuid);
    }

    //判断用户是否登录
    public function isLogin(){
        if (!session('uid')) {
            $this->error('未登录!',U('Index/login'));
        }
            return true;
    }

    //测试菜单
    public function menuList(){
    	$menu = M('menu')->where(array('is_show'=>1))->order('parent_id ASC,sort DESC')->select();
    	$menu = getMenu($menu);
    	if (session('username') == C('SUPER_ADMIN')) {
    		return $menu;
    	}
    	$group = $this->checkRule();
    	$rules = explode(',', $group[0]['rules']);
    	foreach ($menu as $key=>$val) {
    		if (!in_array($val['rule_id'], $rules)) {
    			unset($menu[$key]);
    		}
    	}
        return $menu;
    }
    
    static public function tree(&$data,$pid = 0,$count = 1) {
    	foreach ($data as $key => $value){
    		if($value['parent_id']==$pid){
    			$value['count'] = $count;
    			self::$nodes []=$value;
    			unset($data[$key]);
    			self::tree($data,$value['id'],$count+1);
    		}
    	}
    	return self::$nodes;
    }
    
    /*
     * @author kemao_000
     * 获取全部权限列表
     */
    public function getNodeList() {
    	$list = M('menu')->order('parent_id ASC,sort DESC')->select();
    	return $this->tree($list);
    }
    
    /*
     * @author kemao_000
     * 获取当前位置信息
     */
    private function getPos($id) {
    	static $pos;
    	$res = M('menu')->where(array('Id'=>$id))->find();
    	if ($res['parent_id']) {
    		$this->getPos($res['parent_id']);
    	}
    	$pos[] = $res;
    	return $pos;
    }
    
    private function getTopMenu($id) {
    	$res = M('menu')->where(array('Id'=>$id))->find();
    	if ($res['parent_id']) {
    		$res = $this->getTopMenu($res['parent_id']);
    	}
    	return $res;
    }

    /*
     * @author kemao_000
     * 权限检测，如果通过则返回角色分组信息
     */
    public function checkRule(){
        $auth = new \Think\Auth();
        if (session('username') == C('SUPER_ADMIN')) {
        	return $auth->getGroups(session('uid'));
        }
        if (!$auth->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME,session('uid'))) {
            $this->error('你没有权限!',U('Index/login'));
        } else {
        	return $auth->getGroups(session('uid'));
        }
    }

    /*
     * @author kemao_000
     * 获取菜单id
     */
    public function getMenuId(){
        $url = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
        $Id = M('menu')->where('url=\''.$url.'\'')->getField('Id');
        return $Id;
    }
    
    public function msgreminder(){
    	$uid = session('uid');
    	$this->msglist = M('message')->where(array('to'=>$uid,'is_read'=>0))->select();
    	$this->msgcount = count($this->msglist);
    }
    
    /*
     * 获取提醒信息
     */
    public function reminder(){
    	$uid		= session('uid');
    	if ($this->groups[0]['group_id'] == 2) {
    		$project	= M('project');
    		$today		= strtotime(date('Y-m-d'));
    		$this->ocount = $project->where(array('supervisor'=>$uid,'opening_date'=>$today))->count();
    		$this->ecount = $project->where(array('supervisor'=>$uid,'extract_date'=>$today))->count();
    		$this->ccount = $project->where(array('supervisor'=>$uid,'closing_date'=>$today))->count();
    		$this->reicount = $project->where(array('supervisor'=>$uid,'status'=>array('in','0,2')))->count();
    		$this->comcount = $project->where(array('supervisor'=>$uid,'status'=>array('in','1,3')))->count();
    		$this->otip	= '个项目今日开标';
    		$this->etip = '个项目今日抽专家';
    		$this->ctip = '个项目今日报名截止';
    		$this->reitip = '个项目未报销';
    		$this->comtip = '个项目未汇编';
    	} elseif ($this->groups[0]['group_id'] == 4) {
    		//待审核费用申请列表
    		$applist = M('fee_application')->alias('app')
			    		->join('noah_project project on app.proj_id=project.id')
			    		->where('project.approver='.$uid.' and app.status=1')
			    		->count();
    		//待审核已完结项目
    		$projlist = M('project')->alias('project')
			    		->where('project.status=3 and leader_check=0')
			    		->count();
    		$this->ocount = $applist;
    		$this->ecount = $projlist;
    		$this->otip = '个费用申请待审核';
    		$this->etip = '个完结项目待审核';
    	} elseif ($this->groups[0]['group_id'] == 3) {
    		$projlist = M('project')->alias('project')
			    		->where('project.status=3 and treasurer_check=0')
			    		->count();
    		$this->ecount = $projlist;
    		$this->etip = '个完结项目待审核';  		
    	}
    }

    //图片上传
    public function img_upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     C('SHOP_UPLOAD_URL'); // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // 上传文件 
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            return $info;
        }
    }

    //ck编辑器图片上传
    public function ck_img_upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     C('SHOP_UPLOAD_URL'); // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录

        $fn = intval($_GET['CKEditorFuncNum']);
        // 上传文件 
        $info = $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            echo "<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction(".$fn.", '/', '上传失败," . $upload->getErrorMsg() . "！');</script>";
        }else{// 上传成功
            $savepath = C('SHOP_UPLOAD_URL').$info['upload']['savepath'].$info['upload']['savename'];
            echo "<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction(".$fn.",'$savepath','');</script>";
        }
    }

    //默认index方法
    // public function index(){
    //     $mod = D($this->_name);
    //     $this->list = $mod->
    // }
    //默认add方法
    public function add(){
        $mod = D($this->_name);
        if (IS_POST) {
            if (false === $data = $mod->create()) {
                $this->error($mod->getError());
            }
            if (method_exists($this, '_before_insert')) {
                $data = $this->_before_insert($data);
            }
            if ($fid = $mod->add($data)) {
                if (method_exists($this, '_after_insert')) {
                    $id = $mod->getLastInsID();
                    $this->_after_insert($id);
                }
                $this->success('添加成功!');
            } else {
                $this->error('添加失败!');
            }
        } else {
        	if (method_exists($this, '_before_add')) {
        		$this->_before_add();
        	}
            $this->display();
        }
    }

    //默认修改方法
    public function edit(){
        $mod = D($this->_name);
        $pk = $mod->getPk();
        if (IS_POST) {
            if (false === $data = $mod->create()) {
                $this->error($mod->getError());
            }
            if (method_exists($this, '_before_update')) {
                $data = $this->_before_update($data);
            }
            if (false !== $mod->save($data)) {
                if( method_exists($this, '_after_update')){
                    $id = $data['id'];
                    $this->_after_update($id);
                }
                $this->success('修改成功!');
            } else {
                $this->error('修改失败!');
            }
        } else {
            $id = I($pk, 'intval');
            if (method_exists($this, '_before_edit')) {
            	$this->_before_edit();
            }
            $info = $mod->find($id);
            $this->assign('info', $info);
            $this->display();
        }
    }

    //获取某个分类下的菜品信息
    public function getCaisInfo($caitype){
        $sql = 'select sku.*,cais.name from noah_cai_sku as sku left join noah_cais as cais on sku.cai_id = cais.id where cais.ctid='.$caitype;
        $res = M()->query($sql);
        foreach ($res as $key => $value) {
            $value['name'] = $value['name'].$value['sku_name'];
        }
        return $res;
    }

    //记录后台用户操作信息
    public function recordIt(){
        if (C(IS_LOG)) {
            $log = M('log');
            $logData['uid'] = session('uid');
            $logData['username'] = session('username');
            $logData['url'] = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
            if (IS_POST) {
                $logData['method'] = 'post';
            } else {
                $logData['method'] = 'get';
            }
            $logData['data'] = json_encode(I());
            $logData['time'] = time();
            $log->add($logData);
        }
    }
    //
    public function foodCat($key){
    $cat_arr = array(
        'cardtype'=>array(
            '1'=>'季度',
            '2'=>'半年',
            '3'=>'年卡',
            '4'=>'计次',
            '5'=>'肉蛋卡',
            '6'=>'储值卡'
        ),
        'vehicle'=>array(
            '1'=>'1号车',
            '2'=>'2号车',
            '3'=>'3号车',
            '4'=>'4号车',
            '5'=>'5号车',
            '6'=>'6号车',
            '7'=>'7号车',
            '8'=>'8号车',
            '9'=>'9号车',
            '10'=>'10号车',
            '11'=>'11号车',
            '12'=>'12号车',
            '13'=>'13号车',
            '14'=>'14号车',
            '15'=>'15号车',
            '16'=>'顺丰',
            '17'=>'顺丰优选'
        ),
        'packaging'=>array(
            '1'=>'手提袋',
            '2'=>'盒装',
            '3'=>'袋装',
            '4'=>'乐扣箱',
            '5'=>'礼品盒大',
            '6'=>'礼品盒小',
            '7'=>'顺丰'
        )
    );
    if($key){
        return $cat_arr[$key];
    }else{
        return $cat_arr;
    }
}

	public function getOption($key){
		$option = array(
				'appStatus'=>array(
						'1'=>'待审核',
						'2'=>'未通过',
						'3'=>'已通过',
				),
				'projStatus'=>array(
						'0'=>'未汇编未报销',
						'1'=>'未汇编',
						'2'=>'未报销',
						'3'=>'已完成',
				),
				'msgstatus'=>array(
						'0'=>'未读',
						'1'=>'已读',
				),
		);
		if($key){
			return $option[$key];
		} else {
			return $option;
		}
	}
}