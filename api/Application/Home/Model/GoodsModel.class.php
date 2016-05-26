<?php
/**
 * Created by PhpStorm.
 * User: yaoyu
 * Date: 16/5/26
 * Time: 下午4:14
 */

namespace Home\Model;
use Think\Model;

class GoodsModel {
    
    /*
     * 根据商品ID获得商品信息
     * */
    public function read_good_info($goods_id){
        $id = intval($goods_id);
        return M("Goods")->where("goods_id = $goods_id and is_on_sale=1 and is_delete=0 ")->find();
    }

    /*根据where条件统计商品数量*/
    public function count_by_where($where){
        return M("Goods")->where($where)->count();
    }
    
    /*根据where条件获得商品列表 分页查询*/
    /****
     *$where 查询条件及语句
     *$page 页数
     *$size 每页显示数量
     *$sort 排序
     *$order排序顺序约束
     *$limit 显示条数限制   
     **/
    public function read_list($where,$page,$size,$sort,$order,$limit=0){
	if($limit==0){
            return M("Goods")->field("goods_id,goods_name,cat_id,market_price,shop_price,goods_number,goods_thumb,goods_img,original_img,sales_volume,shop_id,f_money,goods_brief,shop_id,event_id ,event_type")->where($where)->page($page,$size)->order($sort." ".$order)->select();
	}else{
            return M("Goods")->field("goods_id,goods_name,cat_id,market_price,shop_price,goods_number,goods_thumb,goods_img,original_img,sales_volume,shop_id,f_money,goods_brief,shop_id,event_id ,event_type")->where($where)->limit($limit)->page($page,$size)->order($sort." ".$order)->select();
	}
    }
    
    /**
     * 根据$where条件查询goods 返回goods_id
     * @param $where
     * @return mixed
     */
    public function find_goods($where){
        return M('Goods')->where($where)->getField('goods_id',true);
    }
    
    /**
     * 根据shop_id查询Goods_id
     * 查找一个商店内的所有商品id
     * ***/
    public function list_goods_shop_id($shop_id){
        $id = intval($shop_id); 
        return M('Goods')->where('is_on_sale=1 and is_delete=0 and shop_id='.id)->getField('goods_id',true);
    }
}
