<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    
    //显示首页广告位等
    public function index(){

//        $data[0] = "first";
//        $data[1] = "second";
//        $data[2] = "third";
//        $data[3] = "four";
//        echo json_encode($data);
        $this->display();
    }
}