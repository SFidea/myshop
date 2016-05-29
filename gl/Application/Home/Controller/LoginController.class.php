<?php
namespace Home\Controller;
use Think\Controller;
use Home\Util\HttpClient;

class LoginController extends Controller
{
    public function login()
    {
        $this->display();
    }

    public function verifyCodes()
    {
        ob_clean();
        $config = array(
            'fontSize' => 50,    // 验证码字体大小
            'length' => 4,     // 验证码位数
            'useNoise' => false, // 关闭验证码杂点
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    public function checkVerify($code,$id = '')
    {
        $Verify = new \Think\Verify(array('reset'=>false));
        return $Verify->check($code, $id);
    }

    public function check()
    {
        $code = i('post.code','');
        $is_verify = $this->checkVerify($code);
        if($is_verify==false) {
            $this->ajaxReturn(array('status'=>0,'message'=>'验证码错误'));
        }

        $is_remember = i('post.is_remember',0);//是否记住密码
        $account = i('post.account','');
        $password = i('post.password','');      
        $password = md5($password);
        $where = "account = '%s' and password = '%s'";
        $user = M('think_user')->where($where,$account,$password)->find();
                 
        if($user!=false && $user!=null){
            //设置$_SESSION
            $_SESSION[C('USER_AUTH_KEY')]	=	$user['id'];
            $_SESSION['loginAccount']		=	$user['account'];
            
            if($authInfo['account']==C('ADMIN_AUTH_KEY')){
               $_SESSION[C('ADMIN_AUTH_KEY')] = true;//设置超级管理员
            }
            
            //登录成功，写入登录信息
            $save['id']	= $user['id'];
            $save['login_count'] = $user['login_count']+1;
            $save['last_login_time'] = time();
            $save['last_login_ip'] = get_client_ip();
            $user = D('Admin')->updateUser($save);
            
            //记住密码
            if($is_remember == 1){
                cookie('account',base64_encode($account),3600);
                cookie('password',base64_encode($password),3600);
                cookie('is_remember',1,3600);
            }
            $this->ajaxReturn(array('status'=>1,'message'=>"登录成功"));
        }else{
            $this->ajaxReturn(array('status'=>0,'message'=>"用户名密码不正确"));
        }     
    }

    public function dropOut(){
        session(null);
        $this->redirect('Login/login');
    }
}