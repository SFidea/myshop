<?php
/**
 * Created by PhpStorm.
 * User: yaoyu
 * Date: 16/5/26
 * Time: 下午4:14
 * 用户表user
 */
namespace Home\Model;
use Think\Model;

class UsersModel extends Model {

    //根据id判断是否登陆，测试全部返回true
    public function checkLogin($user_id){
        return TRUE;
    }
}
