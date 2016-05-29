<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Model;

use Think\Model;
/**
 * Description of OrderTemplateModel
 *
 * @author yao
 */
class OrderTemplateModel {
    //put your code here
    protected $tableName = 'order_template';
    
    public function index($param){
        $where=' 1=1 ';
        
        if(!empty($param['data'])){
            $where.=' and message like "%'.$param['data'].'%"';
        }
            
        $count=M('order_template')->where($where)->count();
        $size=$param['size'];
        $page_count=ceil($count/$size);
        
        if($param['page']==1){
            $first_row=0;
            $list_row=$size;
        }else{
            $first_row=($param['page']-1)*$size;
            $list_row=$size;
        }
        $arr=M('order_template')->field('id,order_status,shipping_status,pay_status,message')->where($where)->limit($first_row,$list_row)->select();
        return array('count'=>$count,'content'=>$arr);
    }
}
