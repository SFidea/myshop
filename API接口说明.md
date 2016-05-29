
API文件内的接口增减随自己定义，这里我们主要谈一下订单处理流程OrderController控制器内的自定义接口<br>
<br>
一般情况下可以自定义流程，不一定为index,first,可能随项目及需求变化改变，这里只是举了一个例子<br>
统一在function里返回封装json格式
<br>
/*<br>
 * 简易封装json方法<br>
 * 参数：<br>
 * 状态$status: 1=成功 0=失败<br>
 * 成功返回数据$data：PHP数组<br>
 * 失败错误代码$error_code:1,2,3,4,5之类的，可自定义，用于一个controller方法不止一个错误代码反馈的情况<br>
 * 失败错误中文说明$message<br>
 * */<br>
function json_return($status=0,$data="",$message="",$error_code=1){<br>
    $result["status"] = $status;<br>
    $result["data"] = $data;<br>
    $result["message"] = $message;<br>
    $result["error_code"] = $error_code;<br>
    echo json_encode($result); exit;<br>
}<br>
<br>
 /********************************************************<br>
     * index,first,second,third,four 为自定义的方法<br>
     */<br>
    //订单处理主流程<br>
    public function index(){<br>
        json_return(0, '', '订单处理入口', 1);<br>
    }<br>
<br>
    //订单测试处理流程1<br>
    public function first(){<br>
        json_return(0, '', '订单处理流程1', 1);<br>
    }<br>
<br>
    //订单测试处理流程2<br>
    public function second(){<br>
        json_return(0, '', '订单处理流程2', 1);<br>
    }<br>
<br>
    //订单测试处理流程3<br>
    public function third(){<br>
        json_return(0, '', '订单处理流程3', 1);<br>
    }<br>
<br>
    //订单测试处理流程4<br>
    public function four(){<br>
        json_return(0, '', '订单处理流程4', 1);<br>
    }<br>
	
<br>
关键的根据获取订单ID然后取得执行流程json格式的接口为<br>
http://localhost/api/Order/getOrderSort?id=2185<br>
<br>
返回结果为<br>
{<br>
    "status": 1,<br>
    "data": [<br>
        "[{\"cname\":\"Order\",\"methodname\":\"first\"},{\"cname\":\"Order\",\"methodname\":\"second\"},{\"cname\":\"Order\",\"methodname\":\"third\"},{\"cname\":\"Order\",\"methodname\":\"four\"}]"
    ],<br>
    "message": "得到订单执行流程",<br>
    "error_code": 1<br>
}<br>

与订单接口部分代码(其余写在更详细的报告里，这里只写订单有关部分):

	//getOrderSort 传入参数Id，返回订单执行流程模板<br>
    public function getOrderSort(){<br>
        $order_id = intval(I("get.id"));<br>
        $result = D("Order")->order_sort_return($order_id);<br>
        if($result == NULL){<br>
            json_return(0, '', '无此订单流程', 1);<br>
        }else{<br>
            json_return(1, $result[0], '得到订单执行流程', 1);<br>
        }<br>
    }<br>
	
	/*<br>
     * getOderList 根据userid批量获得订单信息<br>
     * $user_id 传入user_id<br>
     */<br>
    public function getOderListWithUserid(){<br>
       $user_id = intval(I("get.userid"));<br>
       $res = D("Users")->checkLogin($user_id);<br>
       if($res){<br>
           $orderlist =  D("Order")->get_order_list($user_id);<br>
            if($orderlist == NULL){<br>
                json_return(0, '', '用户无订单', 1);<br>
            }else{<br>
                json_return(1, $orderlist, '得到用户订单', 1);<br>
            }<br>
       }else{<br>
            json_return(0, '', '用户未登陆', 1);<br>
       }<br>
    }<br>
<br>
    /*<br>
     *getOrderInfo 得到订单详细信息<br> 
     *$order_id 传入订单ID<br>
     *$user_id 传入user_id<br>
     */<br>
    public function getOrderInfo(){<br>
        $order_id = intval(I("get.id"));<br>
        $user_id = intval(I("get.userid"));<br>
        //判断用户是否登陆，否则返回登陆信息<br>
        $res = D("Users")->checkLogin($user_id);<br>
        if($order_id == 0 || $user_id == 0){<br>
            if($res){<br>
                $orderInfo = D("Order")->read_order_info($order_id,$user_id);<br>
                if($orderInfo != NULL){<br>
                    json_return(1, $orderInfo, '获得订单信息成功', 1);<br>
                }else{<br>
                    json_return(0, "", '获得订单失败', 1);<br>
                }<br>
            }else{<br>
                json_return(0, '', '人员未登陆', 1);<br>
            }<br>
        }else{<br>
            json_return(0, '', '传入参数为空', 1);<br>
        }<br>
    }<br>