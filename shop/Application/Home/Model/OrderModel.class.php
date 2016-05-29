<?php
/**
 * Created by PhpStorm.
 * User: yaoyu
 * Date: 2016/5/26
 * Time: 下午4:14
 * 订单表
 */

namespace Home\Model;
use Think\Model;

class OrderModel extends Model {
    
    protected $tableName = 'order_info';
    /**
     * 根据order_id查询order_info订单信息表 返回json执行顺序序列
     * $order_id 订单id
     * @return action_sort 的json排序字段
     */
    public function order_sort_return($order_id){
        $id = intval($order_id);
        $tp_id =  M('order_info')->where("order_id =".$id)->getField('action_sort',true);
        return M('order_sort')->where("id =".$tp_id[0])->getField('controlorder',true);
    }
    
    /**
     * 订单生成及增加
     */
    public function order_add(){
        return M('order_info')->data($data)->add();
    }
    
    /**
     * 订单更新
     */
    public function order_update(){
        return M('order_info')->data($data)->save();   
    }


    /*
     * 根据商品ID和用户信息获得商品信息
     * */
    public function read_order_info($order_id,$user_id){
        $id = intval($order_id);
        $uid = intval($user_id);
        return M('order_info')->where("order_id =".$id." and user_id=".$uid." and is_delete = 0")->find();
    }

    /*
     * 根据id逻辑删除订单状态
     */
    public function del_order_info($order_id){
        $id = intval($order_id);
        $data['is_delete'] = 1;
        return M('order_info')->where("order_id =".$id)->data($data)->save(); // 根据条件更新记录
    }
    
    /*根据where条件统计订单数量*/
    public function count_by_where($where){
        return  M('order_info')->where($where." and is_delete = 0")->count();
    }
}
