<?php
/**
  * 注册rule规则
  * @param class_name string  类的名称
  * @return str           返回错误或者正确信息
 */
function register($class_name){
    $data=get_class_methods($class_name);
//把一些父类的方法过滤掉    $arr=array('_initialize','__set','__construct','display','show','fetch','buildHtml','theme','assign',' __set','get','__get','__isset','__call','error','success','ajaxReturn','redirect','__destruct');
    foreach($arr as $k=>$v){
        if(in_array($arr[$k],$data)){
            $tmp=array_keys($data,$arr[$k]);
            unset($data[$tmp[0]]);
        }
    }
    $obj=M("auth_rule");
    $msg='';
    foreach($data as $k=>$v){
        $data[$k]=CONTROLLER_NAME.'/'.$data[$k];
        if(!$obj->where(array('name'=>$data[$k]))->find()){
            if($obj->add(array('name'=>$data[$k]))){
                $msg=$msg.$data[$k].'注册成功\n';
            }else{
                $msg=$msg.$data[$k].'注册失败\n';
            }
        }else{
            $msg=$msg.$data[$k].'已注册\n' ;
        }
    }
    echo "<script>alert('".$msg."');history.back(-1);</script>";
}
/**
  * 控制模板中菜单的显示
  * @param rule string|array  需要验证的规则列表,支持逗号分隔的权限规则或索引数组
  * @param uid  int           认证用户的id
  * @param string mode        执行check的模式
  * @param relation string    如果为 'or' 表示满足任一条规则即通过验证;如果为 'and'则表示需满足所有规则才能通过验证
  * @return boolean           通过验证返回true;失败返回false
 */
function authCheck($rule,$uid,$type=1, $mode='url', $relation='or'){
    $auth=new \Think\Auth();
    //获取当前uid所在的角色组id
    //$groups=$auth->getGroups($uid);
    if($_SESSION['uname']==C('ADMIN_AUTH_KEY')){
      return true;
    }
    return $auth->check($rule,$uid,$type,$mode,$relation)?true:false;
}

//验证验证码
function check_verify($code, $id = ''){
  $verify = new \Think\Verify();
  return $verify->check($code, $id);
}

//获取后台菜单
function getMenu(&$data, $pid = 0, $count = 0){
  static $treelist = array();
  foreach ($data as $k => $v) {
    if ($v['parent_id'] == $pid) {
      $v['count'] = $count;
      $treelist[] = $v;
      unset($data[$k]);
      getMenu($data, $v['id'], $count+1);
    }
  }
  return $treelist;
}

//导出csv文件
function put_csv($list,$title,$name='CSV'){
	$file_name=$name.date("mdHis",time()).".csv";
	header ( 'Content-Type: application/vnd.ms-excel' );
	header ( 'Content-Disposition: attachment;filename='.$file_name );
	header ( 'Cache-Control: max-age=0' );
	$file = fopen('php://output',"a");
	$limit=1000;
	$calc=0;
	foreach ($title as $v){
		$tit[]=iconv('UTF-8', 'GB2312//IGNORE',$v);
	}
	fputcsv($file,$tit);
	foreach ($list as $v){
		$calc++;
		if($limit==$calc){
			ob_flush();
			flush();
			$calc=0;
		}
		foreach ($v as $t){
			$tarr[]=iconv('UTF-8', 'GB2312//IGNORE',$t);
		}
		fputcsv($file,$tarr);
		unset($tarr);
	}
	unset($list);
	fclose($file);
	exit();
}
