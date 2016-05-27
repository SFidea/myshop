<?php
/**
 * Created by PhpStorm.
 * User: shubo
 * Date: 15/7/6
 * Time: 下午4:28
 */

namespace Home\Controller;
use Think\Controller;
use Home\Util\HttpClient;

class OrderController extends Controller {
    
    //订单处理主流程
    public function index(){
        json_return(0, '', '订单处理入口', 1);
    }

    //订单测试处理流程1
    public function first(){
        json_return(0, '', '订单处理流程1', 1);
    }
    
    //订单测试处理流程2
    public function second(){
        json_return(0, '', '订单处理流程2', 1);
    }
    
    //订单测试处理流程3
    public function third(){
        json_return(0, '', '订单处理流程3', 1);
    }
    
    //订单测试处理流程4
    public function four(){
        json_return(0, '', '订单处理流程4', 1);
    }
    
    //getOrderSort 传入参数Id，返回订单执行流程模板
    public function getOrderSort(){
        $order_id = intval(I("get.id"));
        $result = D("Order")->order_sort_return($order_id);
        if($result == NULL){
            json_return(0, '', '无此订单流程', 1);
        }else{
            json_return(1, $result, '得到订单执行流程', 1);
        }
    }
    
    /*
     *getOrderInfo 得到订单详细信息 
     *$order_id 传入订单ID
     *$user_id 传入user_id
     */
    public function getOrderInfo(){
        $order_id = intval(I("get.id"));
        $user_id = intval(I("get.userid"));
        //判断用户是否登陆，否则返回登陆信息
        $res = D("Users")->checkLogin($user_id);
        if($order_id != 0 && $user_id != 0){
            if($res){
                $orderInfo = D("Order")->read_order_info($order_id);
                json_return(1, $orderInfo, '用户未登陆', 1);
            }else{
                json_return(0, '', '用户未登陆', 1);
            }
        }else{
            json_return(0, '', '传入参数为空', 1);
        }
    }
}
