<?php
/**
 * Created by PhpStorm.
 * User: lihh
 * Date: 2015/7/29
 * Time: 13:33
 */
namespace Home\Model;
use Think\Model;
class RoleUserModel extends Model{
    protected $tableName = 'think_role_user';
    
    /**查询role_user表**/
    public function role_user($id){
        $arr=M('think_role_user')->where('user_id='.$id)->getField('role_id',true);
        return $arr;
    }
    /**添加role_user**/
    public function add_RoleUser($data,$id){
        foreach($data as $vo){
            $param['role_id']=$vo;
            $param['user_id']=$id;
            $num=M('think_role_user')->add($param);
        }
        return $num;
    }
    /**删除role_user**/
    public function delete_RoleUser($id,$data=''){
        if(empty($data)){
            $num=M('think_role_user')->where('user_id='.$id)->delete();
        }else{
            foreach($data as $vo){
                $num=M('think_role_user')->where('user_id='.$id.' and role_id='.$vo)->delete();
            }
        }
        return $num;
    }
}