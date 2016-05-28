<?php
/**
 * Created by PhpStorm.
 * User: yaoyu
 * Date: 2016/5/28
 * Time: 下午2:14
 * 订单执行顺序Sort模板表
 */

namespace Home\Model;
use Think\Model;

class OrderSortModel extends Model {
    
    protected $tableName = 'order_sort';
    /*根据where条件统计模板记录条数*/
    public function count_by_where($where){
        return  M('order_sort')->where($where)->count();
    }
}

