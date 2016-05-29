<?php
/**
 * Created by PhpStorm.
 * User: lihh
 * Date: 2015/7/23
 * Time: 13:55
 */
namespace Home\Model;
use Think\Model;
class RoleModel extends Model{
    public function index($param){
        $where='1=1';
        if($param['data']!=''){
            $where.=' and name like "%'.$param['data'].'%"';
        }
        $count=M('think_role')->where($where)->count();
        $size=$param['size'];
        $count_page=ceil($count/$size);
        if($param['page']==1){
            $first_row=0;
            $list_row = $size;
        }else{
            $first_row=($param['page']-1)*$size;
            $list_row = $size;
        }
        $arr=M('think_role')->field('id,name,remark')->where($where)->limit($first_row,$list_row)->select();
       return array('count'=>$count,'content'=>$arr);

    }
    /**添加角色表**/
    public function add_role($data){
        $data['status']=1;
        $num=M('think_role')->add($data);
        return $num;
    }
    /**查找角色详情**/
    public function list_role($id){
        $arr=M('think_role')->field('id,name,remark')->where('id='.$id)->find();
        return $arr;
    }
    /**删除角色**/
    public function del_role($id){
      $num=M("think_role")->where('id='.$id)->delete();
        return $num;
    }
    /**修改角色**/
    public function update_role($upd,$id){
        $num=M('think_role')->where('id='.$id)->save($upd);
        return $num;
    }
    /**角色的全查询**/
    public function role_list(){
        $arr=M('think_role')->field('id,name')->select();
        return $arr;
    }
}