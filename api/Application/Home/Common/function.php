<?php
/**
 * Created by PhpStorm.
 * User: yaoyu
 * Date: 16/5/26
 * Time: 下午4:30
 */

/*
 * 简易封装json方法
 * 参数：
 * 状态$status: 1=成功 0=失败
 * 成功返回数据$data：PHP数组
 * 失败错误代码$error_code:1,2,3,4,5之类的，可自定义，用于一个controller方法不止一个错误代码反馈的情况
 * 失败错误中文说明$message
 * */
function json_return($status=0,$data="",$message="",$error_code=1){
    $result["status"] = $status;
    $result["data"] = $data;
    $result["message"] = $message;
    $result["error_code"] = $error_code;
    echo json_encode($result); exit;
}

/*
 *发送邮件*
 */
function SendMail($address,$title,$message)
{
    vendor('PHPMailer.PHPMailerAutoload');
    $mail=new PHPMailer();
    // 设置PHPMailer使用SMTP服务器发送Email
    $mail->IsSMTP();

    // 设置邮件的字符编码，若不指定，则为'UTF-8'
    $mail->CharSet='UTF-8';
    $mail->Encoding = "base64"; //编码方式 
    // 添加收件人地址，可以多次使用来添加多个收件人
    $mail->AddAddress($address);
    // 设置邮件正文
    //$mail->Body=$message;
    $mail->Subject    = "This is the subject";
    $mail->AltBody    = "This is the body when user views in plain text format"; //Text Body
    $mail->WordWrap   = 50; // set word wrap
    $mail->MsgHTML($message);
    // 设置邮件头的From字段。
    $mail->From=C('MAIL_ADDRESS');
    // 设置发件人名字
    $mail->FromName='yaoyu';
    // 设置邮件标题
    $mail->Subject=$title;
    // 设置SMTP服务器。
    $mail->Host=C('MAIL_SMTP');
    // 设置为"需要验证"
    $mail->SMTPAuth=true;
    $mail->IsHTML=true;
    // 设置用户名和密码。
    $mail->Username=C('MAIL_LOGINNAME');
    $mail->Password=C('MAIL_PASSWORD');
    // 发送邮件。
    return($mail->Send());
}


/**
 * 得到新订单号
 * @return  string
 */
function get_order_sn(){
    /* 选择一个随机的方案 */
    mt_srand((double) microtime() * 1000000);
    return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
}

/**
* 计算给定时间戳与当前时间相差的天数，并以一种比较友好的方式输出
* @param  [int] $time [给定的时间戳]
* @param  [int] $now_time [要与之相减的时间戳，默认为当前时间]
* @return [int] [相差天数]
*/
function tmspan($time,$now_time=0){
    if(!$now_time){
	$now_time=time();
    }
    $span=$now_time-$time;
    return intval($span/(24*3600));	//四舍五入	
}

//获得用户地区
function getClientArea($address_id=0) {
//    $clinet_area = '';
//    $client_ip = '';
//    if($address_id) {
//        $area = M('user_address')->field('province, city')->where('address_id= '.$address_id )->find();
//        $province = M('region')->where('region_id ='.$area['province'])->getField('region_name');
//        $city = M('region')->where('region_id ='.$area['city'])->getField('region_name');
//        $client_area = $province.','.$city;
//    }else {
//        if(!strstr('192.168', $client_ip)) {
//            $client_ip = get_onlineip();
//        }else {
//            $client_ip = getIP();
//            $client_area = getIPLoc_sina($client_ip);
//        }
//    }
//    return $client_area;
}

// 得到外网域名
function get_onlineip() {
    $onlineip = '';
    if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $onlineip = getenv('HTTP_CLIENT_IP');
    }
    elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $onlineip = getenv('HTTP_X_FORWARDED_FOR');
    }
    elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $onlineip = getenv('REMOTE_ADDR');
    }
    elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $onlineip = $_SERVER['REMOTE_ADDR'];
    }
    return $onlineip;
}

// 利用新浪接口查询ip获取地理位置
function getIPLoc_sina($queryIP){    
	$url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$queryIP;    
	$ch = curl_init($url);     
	curl_setopt($ch,CURLOPT_ENCODING ,'utf8');     
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);   
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
	$location = curl_exec($ch);    
	$location = json_decode($location);    
	curl_close($ch);         
	$loc = "";   
	if($location===FALSE) return "";     
	$loc = $location->province.','.$location->city;  
	return $loc;
}


// 取客户端访问IP
function getIP(){
	if(isset($_SERVER)) {
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$realip = $_SERVER['HTTP_CLIENT_IP'];
		}else{
			$realip = $_SERVER['REMOTE_ADDR'];
		}
	} 
	else{
		if (getenv("HTTP_X_FORWARDED_FOR")) {
			$realip = getenv( "HTTP_X_FORWARDED_FOR");
		}else if (getenv("HTTP_CLIENT_IP")) {
			$realip = getenv("HTTP_CLIENT_IP");
		}else {
			$realip = getenv("REMOTE_ADDR");
		}
	}
	return $realip;
}

//截取字符串
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
    if(function_exists("mb_substr")){
        if($suffix){
            return mb_substr($str, $start, $length, $charset);
        }else{
            return mb_substr($str, $start, $length, $charset);
        }
    }elseif(function_exists('iconv_substr')) {
        if($suffix){
            return iconv_substr($str,$start,$length,$charset);
        }else{
            return iconv_substr($str,$start,$length,$charset);
        }
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix){
        return $slice;
    }else{
        return $slice;
    }
}
	 
