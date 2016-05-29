<?php
return array(
    //让页面显示追踪日志信息
   // 'SHOW_PAGE_TRACE'   => true,
    //url地址大小写不敏感设置
    'URL_CASE_INSENSITIVE'  =>  true,

    //测试服务器 数据库配置信息
    //数据库连接配置
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

    'USER_AUTH_ON'=>true, //是否需要认证
    'USER_AUTH_TYPE'=>2, //认证类型
    'USER_AUTH_KEY'=>'id',  // 认证识别号
    'USER_AUTH_MODEL'=>'ecs_think_user',//模型实例（用户表名）
    'REQUIRE_AUTH_MODULE'=>'',  //需要认证模块
    'NOT_AUTH_MODULE'=>'Login,Index',   //无需认证模块
    'USER_AUTH_GATEWAY'=>'/login/login', //认证网关
    'ADMIN_AUTH_KEY'=>'admin',
    //RBAC_DB_DSN  数据库连接DSN
    'RBAC_ROLE_TABLE'=>'ecs_think_role', //角色表名称
    'RBAC_USER_TABLE'=>'ecs_think_role_user', //用户和角色对应关系表名称
    'RBAC_ACCESS_TABLE'=>'ecs_think_access', //权限分配表名称
    'RBAC_NODE_TABLE'=>'ecs_think_node',  // 权限表名称
    
    //自定义，本地
    'api_domain'=>'http://localhost/api/',
    'gl_domain'=>'http://localhost/gl/',
    'sf_domain'=>'http://localhost/sf/',

);