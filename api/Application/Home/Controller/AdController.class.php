<?php
/**
 * Created by PhpStorm.
 * User: yaoyu
 * Date: 16/5/26
 * Time: 下午4:28
 * 广告位接口
 */

namespace Home\Controller;
use Think\Controller;
class AdController extends Controller {

    public function read(){
        $position_id = I('position_id',0,"intval");
        $limit = I('limit',1,"intval");
        $list = D("Ad")->read_list($position_id,$limit);
        foreach($list as $key=>$vo){
            $list[$key]["ad_code"] = c("static_domain").$vo["ad_code"];
        }
        json_return(1,$list);
    }
    
    /*
     * 一次查找多个广告位
     * */
    public function read_list(){
        $brr=i('post.data','','');
        $arr=json_decode($brr,true);
        $res=array();
        foreach($arr as $key=>$vo){
            $list=D('Ad')->read_list($vo['position_id'],$vo['limit']);
            foreach($list as $key2=>$vo2){
                $list[$key2]["ad_code"] = c("static_domain")."data/afficheimg/".$vo2["ad_code"];
            }
            $res[$vo['position_id']]=$list;
        }
        json_return(1,$res);
    }

    /**
     * 一次查找多个广告位（APP 要用到）
     */
    public function readList(){
        $brr=i('post.data','','');
        $arr=json_decode($brr,true);
        $res=array();
        foreach($arr as $key=>$vo){
            $list=D('Ad')->read_list($vo['position_id'],$vo['limit']);
            foreach($list as $key2=>$vo2){
                $list[$key2]["ad_code"] = c("static_domain").$vo2["ad_code"];
            }
            $res[$vo['position_id']]=$list;
        }
        json_return(1,$res);
    }
}
