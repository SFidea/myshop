<?php
/**
 * Created by PhpStorm.
 * User: lihh
 * Date: 2015/8/4
 * Time: 10:25
 */
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller
{
    //去文档的模型扩展看(_initialize方法可以去例子中查找)
    function _initialize()
    {
        $id=$_SESSION["id"];
        if(empty($id)){
            $this->redirect('Login/login');
        }
        $this->module_name = MODULE_NAME;
        //$this->module_name = CONTROLLER_NAME;
        $this->action_name = ACTION_NAME;
        import('ORG.Util.Cookie');
        // 用户权限检查
//        if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))) {
//            if (!\Org\Util\Rbac::AccessDecision()) {
//                //检查认证识别号
//                if (!$_SESSION [C('USER_AUTH_KEY')]) {
//                    //跳转到认证网关
//                    redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
//                }
//            
//                // 没有权限 抛出错误
//                if (C('RBAC_ERROR_PAGE')) {
//                    // 定义权限错误页面
//                    redirect(C('RBAC_ERROR_PAGE'));
//                } else {
//                    if (C('GUEST_AUTH_ON')) {
//                        $this->assign('jumpUrl', PHP_FILE . C('USER_AUTH_GATEWAY'));
//                    }
//                    // 提示错误信息
//                    $this->error(L('_VALID_ACCESS_'));
//                }
//            }
//        }
    }
}