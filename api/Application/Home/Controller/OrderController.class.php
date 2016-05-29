<?php
/**
 * Created by PhpStorm.
 * User: yao
 */

namespace Home\Controller;
use Think\Controller;
use Home\Util\HttpClient;

class OrderController extends Controller {

    /********************************************************
     * index,first,second,third,four 为自定义的方法
     */
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
            json_return(1, $result[0], '得到订单执行流程', 1);
        }
    }

    /*
     * getOderList 根据userid批量获得订单信息
     * $user_id 传入user_id
     */
    public function getOderListWithUserid(){
       $user_id = intval(I("get.userid"));
       $res = D("Users")->checkLogin($user_id);
       if($res){
           $orderlist =  D("Order")->get_order_list($user_id);
            if($orderlist == NULL){
                json_return(0, '', '用户无订单', 1);
            }else{
                json_return(1, $orderlist, '得到用户订单', 1);
            }
       }else{
            json_return(0, '', '用户未登陆', 1);
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
        if($order_id == 0 || $user_id == 0){
            if($res){
                $orderInfo = D("Order")->read_order_info($order_id,$user_id);
                if($orderInfo != NULL){
                    json_return(1, $orderInfo, '获得订单信息成功', 1);
                }else{
                    json_return(0, "", '获得订单失败', 1);
                }
            }else{
                json_return(0, '', '人员未登陆', 1);
            }
        }else{
            json_return(0, '', '传入参数为空', 1);
        }
    }
    
    /*
     * AddOrder增加订单信息
     * $user_id 传入user_id
     */
    public function addOrderInfo(){
        $user_id = intval(I("get.userid"));
        //判断用户是否登陆，否则返回登陆信息
        $res = D("Users")->checkLogin($user_id);
    }
    
    /*
     * delOrder 逻辑删除订单信息
     * $order_id　传入订单ID
     * $user_id 传入user_id
     * 根据订单order_id及user_id删除订单
     */
    public function delOrderInfo(){
        $order_id = intval(I("get.id"));
        $user_id = intval(I("get.userid"));
        
        //判断用户是否登陆，否则返回登陆信息
        $res = D("Users")->checkLogin($user_id);
        if($order_id == 0 || $user_id == 0){
            if($res){
                $orderInfo = D("Order")->del_order_info($order_id,$user_id);
                if($orderInfo){
                    json_return(1, '', '删除成功', 1);
                }else{
                    json_return(0, '', '删除失败', 1);
                }
            }else{
                json_return(0, '', '用户未登陆', 1);
            }
        }else{
            json_return(0, '', '传入参数为空', 1);
        }
    }
}
