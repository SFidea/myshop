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
    public function first(){
        json_return(0, '', '订单处理流程1', 1);
    }
    
    public function second(){
        json_return(0, '', '订单处理流程2', 1);
    }
    
    public function third(){
        json_return(0, '', '订单处理流程3', 1);
    }
    
    public function four(){
        json_return(0, '', '订单处理流程4', 1);
    }
}
