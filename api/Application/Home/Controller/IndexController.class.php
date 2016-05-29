<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    
    //ad或者广告等
    public function index(){
//        $data[0]["cname"] = "Order";
//        $data[0]["methodname"] = "first";
//        $data[1]["cname"] = "Order";
//        $data[1]["methodname"] = "second";
//        $data[2]["cname"] = "Order";
//        $data[2]["methodname"] = "third";
//        $data[3]["cname"] = "Order";
//        $data[3]["methodname"] = "four";
//        echo json_encode($data);
        //var_dump($orderlist);
        $this->display();
    }
}