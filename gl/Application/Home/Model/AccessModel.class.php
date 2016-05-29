<?php
/**
 * Created by PhpStorm.
 * User: lihh
 * Date: 2015/7/27
 * Time: 11:39
 */
namespace Home\Model;
use Think\Model;
class AccessModel extends Model{
    
    protected $tableName = 'think_access';
    
    /**添加access表**/
    public function add_access($role_id,$node){
        foreach($node as $vo){
            $data['node_id']=$vo['id'];
            $data['level']=$vo['level'];
            $data['pid']=$vo['pid'];
            $data['role_id']=$role_id;
            $num=M("think_access")->add($data);
        }
            return $num;
    }
    /**添加第1级的**/
    public function first_add($role_id){
        $arr['node_id']=1;
        $arr['level']=1;
        $arr['pid']=0;
        $arr['role_id']=$role_id;
        $num=M("think_access")->add($arr);
        return $num;
    }
    /**查找access表**/
    public function list_access($id){
        $arr=M('think_access')->where('role_id='.$id .' and node_id!=1')->getField('node_id',true);

        return $arr;
    }
    /**删除access表中的值**/
    public function del_access($id,$del){
        if(empty($del)){
            $num=M('think_access')->where('role_id='.$id)->delete();
        }else{
          foreach($del as $vo){
              $num=M('think_access')->where('node_id = '.$vo.' and role_id='.$id)->delete();
          }
        }
        return $num;
    }
    /**多id查询**/
    public function arr_list($data){
        $map['role_id']=array('in',$data);
        $arr=M('think_access')->where($map)->getField('node_id',true);
        return $arr;
    }



}