<?php
/**
 * Created by PhpStorm.
 * User: yaoyu
 * Date: 2016/5/28
 * Time: 8:43
 */
namespace Home\Model;
use Think\Model;

class AdminModel extends Model
{
    /**
     * 根据用户名和密码查询登录用户
     * @author yaoyu 16/5/28
     */
    public function readUser($account,$pass)
    {
        $password = md5($pass);
        $where = "account = '%s' and password = '%s'";
        $think_user = M('think_user')->where($where,$account,$password)->find();
        return $think_user;
    }

    /**
     * 根据id修改管理员信息
     * @author 张芝汇 16/3/7
     */
    public function updateUser($data)
    {
        $think_user = M('think_user');
        $data['update_time'] = time();
        $data = $think_user->create($data);
        $res = $think_user->data($data)->where('id = '.$data['id'])->save();
        return $res;
    }


    public function index($param){
        $where='1=1 and account !="admin"';
        
        if(!empty($param['data'])){
            $where.=' and account like "%'.$param['data'].'%"';
        }
            
        $count=M('think_user')->where($where)->count();
        $size=$param['size'];
        $page_count=ceil($count/$size);
        if($param['page']==1){
            $first_row=0;
            $list_row=$size;
        }else{
            $first_row=($param['page']-1)*$size;
            $list_row=$size;
        }
        $arr=M('think_user')->field('id,account,last_login_time,last_login_ip,email,create_time')->where($where)->limit($first_row,$list_row)->select();
        return array('count'=>$count,'content'=>$arr);
    }
        
    /**详情查询**/
    public function details($id){
        $arr=M('think_user')->field('id,account,email,password')->where('id='.$id)->find();
        return $arr;
    }
    /***修改admin**/
    public function update_admin($data,$id){
        $arr=M('think_user')->where('id='.$id)->save($data);
        return $arr;
    }
    /**用户名全查询**/
    public function userName_list($account){
        $arr=M('think_user')->field('id,password')->where('account="'.$account.'"')->find();
        return $arr;
    }
    /**添加admin**/
    public function add_admin($data){
        $data['status']=1;
        $id=M('think_user')->add($data);
        return $id;
    }
    /***删除Admin**/
    public function del_admin($id){
        $num=M('think_user')->where('id='.$id)->delete();
        return $num;
    }

}