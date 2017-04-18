<?php
return array(
	'TMPL_PARSE_STRING' => array('__PUBLIC__'=>'/Public/Admin'),
	'LAYOUT_ON'=>true,
    'LAYOUT_NAME'=>'layout',
	//后台用户权限配置
   'AUTH_CONFIG'=>array(
	   'AUTH_ON' => true, //认证开关
	   'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
	   'AUTH_GROUP' => 'noah_auth_group', //用户组数据表名
	   'AUTH_GROUP_ACCESS' => 'noah_auth_group_access', //用户组明细表
	   'AUTH_RULE' => 'noah_auth_rule', //权限规则表
	   'AUTH_USER' => 'noah_user'//用户信息表
	),
   //超级管理员用户名
   'SUPER_ADMIN'=>'admin',
);