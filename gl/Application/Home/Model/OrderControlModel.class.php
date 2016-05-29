<?php
/**
 * Created by PhpStorm.
 * User: lihh
 * Date: 2015/7/24
 * Time: 17:23
 */
namespace Home\Model;

use Think\Model;

class OrderControlModel extends Model
{
    protected $tableName = 'order_controlname';
    
    public function index($param){
        $where=' is_del=0 ';
        
        if(!empty($param['data'])){
            $where.=' and cname like "%'.$param['data'].'%"';
        }
            
        $count=M('order_controlname')->where($where)->count();
        $size=$param['size'];
        $page_count=ceil($count/$size);
        
        if($param['page']==1){
            $first_row=0;
            $list_row=$size;
        }else{
            $first_row=($param['page']-1)*$size;
            $list_row=$size;
        }
        $arr=M('order_controlname')->field('id,cname,fname,depict,is_del')->where($where)->limit($first_row,$list_row)->select();
        return array('count'=>$count,'content'=>$arr);
    }
}

