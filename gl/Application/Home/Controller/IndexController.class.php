<?php
/**
 * Created by PhpStorm.
 * User: yaoyu
 * Date: 2016/5/29
 * Time: 10:48
 */
namespace Home\Controller;
use Think\Controller;

class IndexController extends CommonController
{
    /**
     * 后台登录显示页面
     */
    public function index()
    {
        $this->display();
    }

    /**
     * 左边菜单栏列表
     */
    public function leftMenuList()
    {
        if($_SESSION['loginAccount'] == 'admin'){
            //是超级管理员，显示所有
            $first_list = D('Node')->readFirstNode();
            foreach($first_list as $key=>$first){
                $second_list = D('Node')->readSecondNode($first['id']);
                $first_list[$key]['second_list'] = $second_list;
            }
            $nodeList = $first_list;
        }else{
            //其他管理员，需要角色设置            
            $role_id_arr = D('RoleUser')->role_user($_SESSION['id']);
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
                $nodeList = $first;
            }
        }
        return $nodeList;
    }
}


