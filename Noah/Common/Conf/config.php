<?php
return array(
	//数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'oatest', // 数据库名
    'DB_USER'   => 'oatest', // 用户名
    'DB_PWD'    => 'oatest', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'noah_', // 数据库表前缀 
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增
	//'配置项'=>'配置值'
    'TOKEN_ON'      =>    false,  // 是否开启令牌验证 默认关闭
    'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true

    'URL_HTML_SUFFIX'=>'',
    //菜品图片上传路径
    'SHOP_UPLOAD_URL' =>'./Public/Upload/',
    //是否开启后台日志功能
    'IS_LOG'=>false,
);