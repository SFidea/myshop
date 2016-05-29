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
        $title = "indexControl";
        $id = intval(I("get.order_id"));    //订单id
        $step = 0;
        
        $result = D("Order")->order_sort_return($id);
        if($result == NULL){
            $this->error("没有找到流程");
        }
         
        $actionList = json_decode($result[0], true);
        $nextOrder = $actionList[$step]["cname"];
        $nextFun = $actionList[$step]["methodname"];
        
         //步骤加1
        $step = $step + 1;
        $this->assign('id', $id);
        $this->assign('title',$title);
        $this->assign('nextOrder',$nextOrder);
        $this->assign('nextFun',$nextFun);
        $this->assign('step',$step);
        $this->display("index");
    }
    
    //订单测试处理流程1
    public function first(){
        $title = "first";
        $id = intval(I("get.order_id"));
        $step = intval(I("get.step"));  //步骤id
        
        $result = D("Order")->order_sort_return($id);
        if($result == NULL){
            $this->error("没有找到流程");
        }
        $actionList = json_decode($result[0], true);
        $nextOrder = $actionList[$step]["cname"];
        $nextFun = $actionList[$step]["methodname"];

        //步骤加1
        $step = $step + 1;
        $this->assign('id', $id);
        $this->assign('title',$title);
        $this->assign('nextOrder',$nextOrder);
        $this->assign('nextFun',$nextFun);
        $this->assign('step',$step);
        $this->display("index");
    }
    
    //订单测试处理流程2
    public function second(){
        $title = "second";
        $id = intval(I("get.order_id"));
        $step = intval(I("get.step"));  //步骤id
       
        $result = D("Order")->order_sort_return($id);
        if($result == NULL){
            $this->error("没有找到流程");
        }
        $actionList = json_decode($result[0], true);
        $nextOrder = $actionList[$step]["cname"];
        $nextFun = $actionList[$step]["methodname"];
        
        //步骤加1
        $step = $step + 1;
        $this->assign('id', $id);
        $this->assign('title',$title);
        $this->assign('nextOrder',$nextOrder);
        $this->assign('nextFun',$nextFun);
        $this->assign('step',$step);
        $this->display("index");
    }
    
    //订单测试处理流程3
    public function third(){
        $title = "third";
        $id = intval(I("get.order_id"));
        $step = intval(I("get.step"));  //步骤id
        
        $result = D("Order")->order_sort_return($id);
        if($result == NULL){
            $this->error("没有找到流程");
        }
        $actionList = json_decode($result[0], true);
        $nextOrder = $actionList[$step]["cname"];
        $nextFun = $actionList[$step]["methodname"];
        
        //步骤加1
        $step = $step + 1;
        $this->assign('id', $id);
        $this->assign('title',$title);
        $this->assign('nextOrder',$nextOrder);
        $this->assign('nextFun',$nextFun);
        $this->assign('step',$step);
        $this->display("index");
    }
    
    //订单测试处理流程4
    public function four(){
        $title = "four";
        $id = intval(I("get.order_id"));
        $step = intval(I("get.step"));  //步骤id
        
        $result = D("Order")->order_sort_return($id);
        if($result == NULL){
            $this->error("没有找到流程");
        }
        $actionList = json_decode($result[0], true);
        $nextOrder = $actionList[$step]["cname"];
        $nextFun = $actionList[$step]["methodname"];
        //步骤加1
        $step = $step + 1;
        $this->assign('id', $id);
        $this->assign('title',$title);
        $this->assign('nextOrder',$nextOrder);
        $this->assign('nextFun',$nextFun);
        $this->assign('step',$step);
        $this->display("index");
    }
    
    //订单测试处理流程5
    public function end(){
        $title = "end";
        $id = intval(I("get.order_id"));
        $step = intval(I("get.step"));  //步骤id
        
        $result = D("Order")->order_sort_return($id);
        if($result == NULL){
            $this->error("没有找到流程");
        }
        $actionList = json_decode($result[0], true);
        $nextOrder = $actionList[$step]["cname"];
        $nextFun = $actionList[$step]["methodname"];
        $this->assign('id', $id);
        $this->assign('title',$title);
        $this->assign('nextOrder',$nextOrder);
        $this->assign('nextFun',$nextFun);
        $this->assign('step',$step);
        $this->display("index");
    }
}
