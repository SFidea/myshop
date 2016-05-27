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
        return M('order_info')->where("order_id =".$id)->getField('action_sort',true);
    }
    
    /*
     * 根据商品ID获得商品信息
     * */
    public function read_order_info($order_id){
        $id = intval($order_id);
        return M('order_info')->where("order_id =".$id)->find();
    }

    /*根据where条件统计订单数量*/
    public function count_by_where($where){
        return  M('order_info')->where($where)->count();
    }
}
