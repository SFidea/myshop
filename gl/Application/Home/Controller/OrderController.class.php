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
}
