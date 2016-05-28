<?php
/* 
 * 订单状态模板表
 */

namespace Home\Model;
use Think\Model;

class OrderTemplateModel extends Model {
    protected $tableName = 'order_template';
    
    /*
     * 根据ID获得模板表里的
     * 控制器名称和方法
     * */
    public function template_info($id){
        $id = intval($id);
        return M('order_template')->where("id =".$id)->find();
    }

    /*
     * 增加控制器与方法影射
     */
    public function cminfo_add($data){
        return M('order_template')->data($data)->add();   
    }
    
    /*
     * 编辑状态方法
     */
    public function cminfo_edit($data){ 
        return M('order_template')->data($data)->save();   
    }

    /*
     * 根据id删除状态
     */
    public function del_order_info($id){
        return M('order_template')->where("id =".$id)->data($data)->save(); // 根据条件更新记录
    }
    
    /*根据where条件统计数量*/
    public function count_by_where($where){
        return  M('order_template')->where($where)->count();
    }
}
