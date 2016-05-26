<?php
/**
 * Created by PhpStorm.
 * User: yaoyu
 * Date: 16/5/26
 * Time: 下午4:14
 */

namespace Home\Model;
use Think\Model;

//广告位列表获取
class AdModel {

    /**
     * @param type $position_id 位置ID 
     * @param type $limit 广告数量
     * @return $list;
     */
    public function read_list($position_id,$limit){
        $m = M("Ad");
        $list = $m->field("ad_id, ad_name,ad_link,ad_code,target_type,target_id,position_id")->where("position_id=$position_id")
                    ->limit($limit)
                    ->select();
        return $list;
    }


}
