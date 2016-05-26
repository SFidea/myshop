<?php
return array(
    //'配置项'=>'配置值'
    //测试服务器 数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'myshop', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'ecs_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'URL_MODEL' =>2,
    'MODULE_ALLOW_LIST'    =>    array('Home'),	//模块列表
    'DEFAULT_MODULE'       =>    'Home',  // 默认模块
    //自定义
    'main_domain'	=> 'http://localhost/gl/',
    'static_domain'	=> 'http://localhost/static/',//静态资源地址
    'gl_domain'	=> 'http://localhost/gl/',//
    'm_domain'=>'http://localhost/mobile/',//wap网页地址
    'api_domain'=>'http://localhost/api/',//接口地址
    'MAIL_ADDRESS'=>'', // 邮箱地址
    'MAIL_SMTP'=>'', // 邮箱SMTP服务器
    'MAIL_LOGINNAME'=>'', // 邮箱登录帐号
    'MAIL_PASSWORD'=>'', // 邮箱密码
);