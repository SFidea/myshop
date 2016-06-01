<?php
/**
 * Created by PhpStorm.
 * User: lihh
 * Date: 2015/7/23
 * Time: 14:09
 */
namespace Home\Controller;
use Home\Util\Page;
use Think\Controller;

class OrderController extends CommonController{
    
    //流程执行顺序列表
    public function index(){
        $page=intval(i('p'));
        $size=20;
        $data=i('seek');
        
        $param['data']=$data;
        if($page==0){
            $page=1;
        }
        $param['page']=$page;
        $param['size']=$size;
        $arr=D('Order')->index($param);

        $page=new Page($arr['count'],$size);
        $page_show=$page->show();
        $this->assign('content',$arr['content']);
        $this->assign('page',$page_show);
        $this->assign('title',array('one_title'=>'流程模板','two_title'=>'流程列表'));
        $this->display();
    }
    
    //流程对应控制器与方法队列
    public function cindex(){
        $page=intval(i('p'));
        $size=20;
        $data=i('seek');
        
        $param['data']=$data;
        if($page==0){
            $page=1;
        }
        $param['page']=$page;
        $param['size']=$size;
        $arr=D('OrderControl')->index($param);

        $page=new Page($arr['count'],$size);
        $page_show=$page->show();
        $this->assign('content',$arr['content']);
        $this->assign('page',$page_show);
        $this->assign('title',array('one_title'=>'流程模板','two_title'=>'映射列表'));
        $this->display();
    }
    
    //订单状态自定义
    public function sindex(){
        $page=intval(i('p'));
        $size=20;
        $data=i('seek');
        
        $param['data']=$data;
        if($page==0){
            $page=1;
        }
        $param['page']=$page;
        $param['size']=$size;
        $arr=D('OrderTemplate')->index($param);

        $page=new Page($arr['count'],$size);
        $page_show=$page->show();
        $this->assign('content',$arr['content']);
        $this->assign('page',$page_show);
        $this->assign('title',array('one_title'=>'流程模板','two_title'=>'订单自定义'));
        $this->display();
    }
    
    public function order_add(){
        
        $this->display();
    }
    
    /**编辑流程模板**/
    public function edit_order(){
        $data['id']=intval(i('id'));
        $data['name']=i('name');
        $data['controlorder']=i('controlorder');
        
        if($data['id']>0){
            
        }else{
            /**添加**/
            if(!empty($data['name'])){
                if(!empty($data['controlorder'])){
                    $param=array('name'=>$data['name'],'controlorder'=>$data['controlorder'],'is_del'=>0);
                    $res=D('Order')->add_orderSort($param); //增加订单规则
                    if($res>0){
                        echo json_encode(array('status'=>1,'data'=>'add','message'=>'添加流程成功'));
                    }else{
                        echo json_encode(array('status'=>0,'data'=>'add','message'=>'添加流程失败！请重试！'));
                    }
                }else{
                    echo json_encode(array('status'=>0,'data'=>'add','message'=>'必须有流程'));
                }
            }else{
                echo json_encode(array('status'=>0,'data'=>'add','message'=>'流程名称必须有'));
            }
        }
    }
}
