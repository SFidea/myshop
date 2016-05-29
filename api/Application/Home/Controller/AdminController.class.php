<?php
/**
 * Created by PhpStorm.
 * User: yaoyu  
 * Date: 2016/5/26
 * Time: 8:42
 */
namespace Home\Controller;

use Think\Controller;

class AdminController extends Controller
{
    /**
     * 后台登录，判断是否登录成功
     * @param string $account 帐号
     * @param string $password 密码
     * @author yaoyu
     * post
     */
    public function doLogin()
    {
        $arr = i('post.data','','');
        $data = json_decode($arr,true);
        $account = empty($data['account']) ? '' : ($data['account']);//帐号
        $password = empty($data['password']) ? '' : ($data['password']);//密码

        if(empty($account) || empty($password)){
            json_return(0,'','账号或密码为空，请重新登录！');
        }

        $user = D('Admin')->readUser($account,$password);
        if($user===false || $user==null){
            json_return(0,'','帐号不存在或密码错误！');
        }
        
        json_return(1,$user,'登录成功！');
    }

    /**
     * 后台登录登录成功，写入登录信息
     * @param intval $id 管理员id
     * @param string $last_login_time 最后登录时间
     * @param string $last_login_ip 最后登录IP
     * @author yaoyu 16/3/7
     * post
     */
    public function saveUser()
    {
        $arr = i('post.data','','');
        $data = json_decode($arr,true);
        $user = D('Admin')->updateUser($data);
        if($user===false){
            json_return(0,'','信息错误，修改失败！');
        }
        json_return(1,$user,'信息修改成功！');
    }

    /**
     * 后台左侧菜单栏,最高权限管理员菜单
     * @author yaoyu 16/3/8
     * get
     */
    public function getNodeList()
    {
        $first_list = D('Node')->readFirstNode();
        foreach($first_list as $key=>$first){
            $second_list = D('Node')->readSecondNode($first['id']);
            $first_list[$key]['second_list'] = $second_list;
        }
        //echo json_encode($first_list);
        json_return(1,$first_list);
    }

    /**
     * 后台左侧菜单栏,根据管理员id查询他的权限菜单
     * @param intval $id 管理员id
     * @author yaoyu 16/3/8
     * get
     */
    public function getRoleMenu(){
        $id = intval(i('id',0));
        $role_id_arr = D('RoleUser')->role_user($id);
        $node_list_arr = D('Access')->arr_list($role_id_arr);
        $arr = array_flip(array_flip($node_list_arr));
        $first = array();//一级菜单
        $second = array();//二级菜单
        foreach($arr as $key=>$vo){
            $node = D('Node')->readNode($vo);
            if($node['pid']==1){
                $first[]= $node;
            }
            elseif($node['pid']!=0 and $node['pid']!=1){
                $second[]= $node; //二级菜单
            }
        }
        if(empty($first)){
            json_return(0,'','请联系管理员，您没有本后台的所有权限！');
        }else{
            foreach($first as $key1=>$vo1){
                foreach($second as $key2=>$vo2){
                    if($vo2['pid']==$vo1['id']){
                        $first[$key1]['second_list'][] = $vo2;
                    }
                }
            }
            json_return(1,$first);
        }
    }

    public function index($size=0){
        $page=intval(i('page'));
        if($page==0){
            $page=1;
        }
        $param['page']=$page;
        $param['data']=i('data');
        if(empty($size)){
            json_return(0,'','size empty');
        }
        $param['size']=$size;
        $arr=D('Admin')->index($param);
        json_return(1,$arr);
    }
    
    /**查找所有角色名**/
    public function list_role(){
        $arr=D('Role')->role_list();
        json_return(1,$arr);
    }
    
    /**详情查询**/
    public function details(){
        $id=intval(i('id'));
        $arr=D('Admin')->details($id);
        json_return(1,$arr);
    }
    
    /**查询user_role表**/
    public function list_role_user(){
        $id=intval(i('id'));
        $arr=D('RoleUser')->role_user($id);
        json_return(1,$arr);
    }
    
    /**修改Admin**/
    public function update_admin(){
        $brr=i('post.data','','');
        $arr=json_decode($brr,true);
        $det=D('Admin')->details($arr['id']);
        if(!empty($arr['password'])){
            if($det['password']==md5($arr['password'])){
                if(!empty($arr['new_password']) and strlen($arr['new_password'])>5){
                    if($arr['new_password']==$arr['affirm_password']){
                        $param['email']=$arr['email'];
                        $param['password']=md5($arr['new_password']);
                        $param['update_time']=time();
                        $up_num=D('Admin')->update_admin($param,$arr['id']);
                    }else{
                        json_return(0,'update','修改失败！两次输入的新密码不同！');
                    }
                }else{
                    json_return(0,'update','修改失败！密码不能为空或小于6');
                }
            }else{
                json_return(0,'update','修改失败！旧密码输入错误！');
            }
        }else{
            if($arr['email']!=$det['email']){
                $param['email']=$arr['email'];
                $param['update_time']=time();
                $up_num=D('Admin')->update_admin($param,$arr['id']);
            }
        }
        $dd=D('RoleUser')->role_user($arr['id']);
        if(!empty($dd)){
            $del=array_diff($dd,$arr['role']);
            if(!empty($del)){
                $del_num=D('RoleUser')->delete_RoleUser($arr['id'],$del);
            }
            $add=array_diff($arr['role'],$dd);
            if(!empty($add)){
                $add_num=D('RoleUser')->add_RoleUser($add,$arr['id']);
            }
        }else{
            if(!empty($arr['role'])){
                $add_num=D('RoleUser')->add_RoleUser($arr['role'],$arr['id']);
            }
        }
        if($add_num>=0 or $del_num>=0 or $up_num>=0){
            json_return(1,'update','修改成功！');
        }else{
            json_return(0,'update','修改失败，请重试！');
        }
    }
    
    /**添加Admin**/
    public function add_admin(){
        $brr=i('post.data','','');
        $arr=json_decode($brr,true);
        $num=D('Admin')->userName_list($arr['account']);
        if(!empty($num)){
            json_return(0,'add','添加失败！用户名已存在！');
        }else{
                $param['account']=$arr['account'];
                $param['password']=md5($arr['password']);
                $param['email']=$arr['email'];
                $param['create_time']=time();
                $id=D('Admin')->add_admin($param);
        }
        if(!empty($arr['role'])){
            $add_num=D('RoleUser')->add_RoleUser($arr["role"],$id);
        }
        if($id>0 or $add_num>0){
            json_return(1,'add','添加成功！');
        }else{
            json_return(0,'add','添加失败！请重试！');
        }
    }

    /***删除Admin**/
    public function del_admin(){
        $id=intval(i('id'));
        $R_num=D('RoleUser')->delete_RoleUser($id);
        $A_num=D('Admin')->del_admin($id);
        if($R_num>0 or $A_num>0){
            json_return(1,'','删除成功！');
        }else{
            json_return(0,'','删除失败，请重试！');
        }
    }

    /***Login根据account查找**/
    public function account_list(){
        $account=i('account');
        $arr=D('Admin')->userName_list($account);
        if(empty($arr)){
            json_return(0,'','用户名不存在！');
        }else{
            json_return(1,$arr);
        }
    }
    
    /**根据admin_id查找node**/
    public function list_node(){
        $id=intval(i('id'));
        $role_id_arr=D('RoleUser')->role_user($id);

        $node_list_arr=D("Access")->arr_list($role_id_arr);

        $arr=array_flip(array_flip($node_list_arr));
        $list=array();
        foreach($arr as $key=>$vo){
            $s=D('Node')->list_node($vo);
            if($s['pid']==1){
                $list['first'][$key]=$s;
            }elseif($s['pid']!=0 and $s['pid']!=1){
                $list['second'][$key]=$s;
            }
        }
        if(empty($list)){
            json_return(0,'','请联系管理员，您没有本后台的所有权限！');
        }else{
            json_return(1,$list);
        }
    }
    
    public function list_node_all(){
        $s=D('Node')->index_left();
        json_return(1,$s);
    }
}
