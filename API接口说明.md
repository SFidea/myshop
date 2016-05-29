
API�ļ��ڵĽӿ��������Լ����壬����������Ҫ̸һ�¶�����������OrderController�������ڵ��Զ���ӿ�<br>
<br>
һ������¿����Զ������̣���һ��Ϊindex,first,��������Ŀ������仯�ı䣬����ֻ�Ǿ���һ������<br>
ͳһ��function�ﷵ�ط�װjson��ʽ
<br>
/*<br>
 * ���׷�װjson����<br>
 * ������<br>
 * ״̬$status: 1=�ɹ� 0=ʧ��<br>
 * �ɹ���������$data��PHP����<br>
 * ʧ�ܴ������$error_code:1,2,3,4,5֮��ģ����Զ��壬����һ��controller������ֹһ��������뷴�������<br>
 * ʧ�ܴ�������˵��$message<br>
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
     * index,first,second,third,four Ϊ�Զ���ķ���<br>
     */<br>
    //��������������<br>
    public function index(){<br>
        json_return(0, '', '�����������', 1);<br>
    }<br>
<br>
    //�������Դ�������1<br>
    public function first(){<br>
        json_return(0, '', '������������1', 1);<br>
    }<br>
<br>
    //�������Դ�������2<br>
    public function second(){<br>
        json_return(0, '', '������������2', 1);<br>
    }<br>
<br>
    //�������Դ�������3<br>
    public function third(){<br>
        json_return(0, '', '������������3', 1);<br>
    }<br>
<br>
    //�������Դ�������4<br>
    public function four(){<br>
        json_return(0, '', '������������4', 1);<br>
    }<br>
	
<br>
�ؼ��ĸ��ݻ�ȡ����IDȻ��ȡ��ִ������json��ʽ�Ľӿ�Ϊ<br>
http://localhost/api/Order/getOrderSort?id=2185<br>
<br>
���ؽ��Ϊ<br>
{<br>
    "status": 1,<br>
    "data": [<br>
        "[{\"cname\":\"Order\",\"methodname\":\"first\"},{\"cname\":\"Order\",\"methodname\":\"second\"},{\"cname\":\"Order\",\"methodname\":\"third\"},{\"cname\":\"Order\",\"methodname\":\"four\"}]"
    ],<br>
    "message": "�õ�����ִ������",<br>
    "error_code": 1<br>
}<br>

�붩���ӿڲ��ִ���(����д�ڸ���ϸ�ı��������ֻд�����йز���):

	//getOrderSort �������Id�����ض���ִ������ģ��<br>
    public function getOrderSort(){<br>
        $order_id = intval(I("get.id"));<br>
        $result = D("Order")->order_sort_return($order_id);<br>
        if($result == NULL){<br>
            json_return(0, '', '�޴˶�������', 1);<br>
        }else{<br>
            json_return(1, $result[0], '�õ�����ִ������', 1);<br>
        }<br>
    }<br>
	
	/*<br>
     * getOderList ����userid������ö�����Ϣ<br>
     * $user_id ����user_id<br>
     */<br>
    public function getOderListWithUserid(){<br>
       $user_id = intval(I("get.userid"));<br>
       $res = D("Users")->checkLogin($user_id);<br>
       if($res){<br>
           $orderlist =  D("Order")->get_order_list($user_id);<br>
            if($orderlist == NULL){<br>
                json_return(0, '', '�û��޶���', 1);<br>
            }else{<br>
                json_return(1, $orderlist, '�õ��û�����', 1);<br>
            }<br>
       }else{<br>
            json_return(0, '', '�û�δ��½', 1);<br>
       }<br>
    }<br>
<br>
    /*<br>
     *getOrderInfo �õ�������ϸ��Ϣ<br> 
     *$order_id ���붩��ID<br>
     *$user_id ����user_id<br>
     */<br>
    public function getOrderInfo(){<br>
        $order_id = intval(I("get.id"));<br>
        $user_id = intval(I("get.userid"));<br>
        //�ж��û��Ƿ��½�����򷵻ص�½��Ϣ<br>
        $res = D("Users")->checkLogin($user_id);<br>
        if($order_id == 0 || $user_id == 0){<br>
            if($res){<br>
                $orderInfo = D("Order")->read_order_info($order_id,$user_id);<br>
                if($orderInfo != NULL){<br>
                    json_return(1, $orderInfo, '��ö�����Ϣ�ɹ�', 1);<br>
                }else{<br>
                    json_return(0, "", '��ö���ʧ��', 1);<br>
                }<br>
            }else{<br>
                json_return(0, '', '��Աδ��½', 1);<br>
            }<br>
        }else{<br>
            json_return(0, '', '�������Ϊ��', 1);<br>
        }<br>
    }<br>