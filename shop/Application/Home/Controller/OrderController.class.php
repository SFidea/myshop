<?php
/**
 * Created by PhpStorm.
 * User: yaoyu
 */

namespace Home\Controller;
use Think\Controller;
use Home\Util\HttpClient;

class OrderController extends Controller {
    
    //根据订单自定义流程定义订单的处理流程    
    private $actionList = array();
    
    //订单处理主流程
    public function index(){
        $content = "";
        $title = "indexControl";
        $id = intval(I("get.order_id"));
        $eventUrl = C('api_domain').'Order/getOrderSort?id ='.$id;
        $sortJson = json_decode(file_get_contents($eventUrl),true);
        $sortData = $sortJson['data'];
        var_dump($sortJson);
        
        $next = "first";
        $this->assign('id', $id);
        $this->assign('title',$title);
        $this->assign('content',$content);
        $this->assign('next',$next);
        $this->display("index");
    }

    //订单测试处理流程1
    public function first(){
        $content = "";
        $title = "first";
        $id = intval(I("get.order_id"));
        
        $next = "second";
        $this->assign('id', $id);
        $this->assign('title',$title);
        $this->assign('content',$content);
        $this->assign('next',$next);
        $this->display("index");
    }
    
    //订单测试处理流程2
    public function second(){
       $content = ""; 
       $title = "second";
       $id = intval(I("get.order_id"));
       
       $next = "third";
       $this->assign('id', $id);
       $this->assign('title',$title);
       $this->assign('content',$content);
       $this->assign('next',$next);
       $this->display("index");
    }
    
    //订单测试处理流程3
    public function third(){
        $content = "";
        $title = "third";
        $id = intval(I("get.order_id"));
        
        $next = "four";
        $this->assign('id', $id);
        $this->assign('title',$title);
        $this->assign('content',$content);
        $this->assign('next',$next);
        $this->display("index");
    }
    
    //订单测试处理流程4
    public function four(){
        $content = "";
        $title = "four";
        $id = intval(I("get.order_id"));
        
        $next = "end";
        $this->assign('id', $id);
        $this->assign('title',$title);
        $this->assign('content',$content);
        $this->assign('next',$next);
        $this->display("index");
    }
    
    //订单测试处理流程5
    public function end(){
        $content = "";
        $title = "four";
        
        $next = "end";
        $this->assign('id', $id);
        $this->assign('title',$title);
        $this->assign('content',$content);
        $this->assign('next',$next);
        $this->display("index");
    }
}
