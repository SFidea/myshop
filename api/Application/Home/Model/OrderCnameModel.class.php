<?php
/**
 * Created by PhpStorm.
 * User: yaoyu
 * Date: 2016/5/26
 * Time: 下午4:14
 * 模板表分表,主要放控制器和方法对应关系
 */

namespace Home\Model;
use Think\Model;

class OrderCnameModel extends Model {
    
    protected $tableName = 'order_controlname';

    /*
     * 根据ID获得模板表里的
     * 控制器名称和方法
     * */
    public function control_mname_info($id){
        $id = intval($id);
        return M('order_controlname')->where("id =".$id)->find();
    }

    /*
     * 增加控制器与方法影射
     */
    public function cminfo_add($data){
        return M('order_controlname')->data($data)->add();   
    }
    
    /*
     * 编辑控制器方法
     */
    public function cminfo_edit($data){ 
        return M('order_controlname')->data($data)->save();   
    }

    /*
     * 根据id逻辑删除控制器名称和方法
     */
    public function del_order_info($id){
        $id = intval($id);
        $data['is_del'] = 1;
        return M('order_controlname')->where("id =".$id)->data($data)->save(); // 根据条件更新记录
    }
    
    /*根据where条件统计订单数量*/
    public function count_by_where($where){
        return  M('order_controlname')->where($where)->count();
    }
}

