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
class RoleController extends CommonController{
    public function role_index(){
        $page=intval(i('p'));
        $size=20;
        $data=i('seek');
        
        $param['data']=$data;
        if($page==0){
            $page=1;
        }
        $param['page']=$page;
        $param['size']=$size;
        $arr=D('Role')->index($param);

        $page=new Page($arr['count'],$size);
        $page_show=$page->show();
        $this->assign('content',$arr['content']);
        $this->assign('page',$page_show);
        $this->assign('title',array('one_title'=>'角色管理','two_title'=>'角色列表'));
        $this->display();
    }
    
    /**角色添加页面**/
    public function role_add(){
        $arr=D('Node')->index();
        $this->assign('first_list',$arr['first']);
        $this->assign('second_list',$arr['second']);
        $this->assign('title',array('one_title'=>'角色管理','two_title'=>'角色添加'));
        $this->display();
    }
    
   /**详情页面**/
    public function role_details(){
        $id=intval(i('id'));
        $arr=D('Role')->list_role($id);     
        $this->assign('content',$arr);
        
        $arr=D('Access')->list_access($id);
        $this->assign('node',$ass);
        
        $arr=D('Node')->index();
        $this->assign('first_list',$arr['first']);
        $this->assign('second_list',$arr['second']);
        
        $u='http://'.$_SERVER['SERVER_NAME'];
        $r=$_SERVER['HTTP_REFERER'];
        $l=str_replace($u,'',$r);
        $url=str_replace('.html','',$l);
        $this->assign('url',$url);
        $this->assign('title',array('one_title'=>'角色管理','two_title'=>'角色编辑'));
        $this->display('role_add');
    }
    
    /**删除角色**/
    public function del_role(){
        $id=intval(i('id'));
        $d=file_get_contents(c('api_domain').'Role/del_role?id='.$id); 
        $role_num=D('Role')->del_role($id);
        $access_num=D('Access')->del_access($id);
        if($role_num>0 and $access_num>0){
            json_return(1,'','删除成功！');
        }else{
            json_return(0,'','删除失败，请重试！');
        }
    }
    
    /**编辑角色**/
    public function edit_role(){
        $data['id']=intval(i('id'));
        $arr=array();
        foreach (i('node') as $key=>$vo) {
            $arr[$key]=intval($vo);
        }
        $data['node']=$arr;
        $data['name']=i('name');
        $data['remark']=i('remark');
        
        if($data['id']>0){
            /**修改**/
            if(!empty($data['name'])){
                if(!empty($data['node'])){
                    $param=array('name'=>$data['name'],'remark'=>['remark']);
                    $det=D('Role')->list_role($data['id']);
                    $upd=array_diff($param,$det);
                    if(empty($upd)){}
                    else{
                       $role_num=D('Role')->update_role($upd,$data['id']);
                    }
                    $ars=D('Access')->list_access($data['id']);
                    if(empty($ars)){
                        $ars=array();
                    }
                    
                    $del=array_diff($ars,$data['node']);
                    if(empty($del)){
                        $add=array_diff($data['node'],$ars);
                        $per=D('Node')->arr_list($add);
                        $acc_num=D('Access')->add_access($data['id'],$per);
                    }else{
                        $access_num=D('Access')->del_access($data['id'],$del);
                        $add=array_diff($data['node'],$ars);
                        $per=D('Node')->arr_list($add);
                        $acc_num=D('Access')->add_access($data['id'],$per);
                    }
                    if($acc_num>0 or $role_num>0 or $access_num>0){
                        echo json_encode(array('status'=>1,'data'=>'update','message'=>'修改成功'));
                    }else{
                        echo json_encode(array('status'=>0,'data'=>'update','message'=>'修改失败，请重试！'));
                    }
                }else{
                    echo json_encode(array('status'=>0,'data'=>'update','message'=>'必须有权限'));
                }
            }else{
                echo json_encode(array('status'=>0,'data'=>'update','message'=>'角色名必须有'));
            }
        }else{
            /**添加**/
            if(!empty($data['name'])){
                if(!empty($data['node'])){
                    $param=array('name'=>$data['name'],'remark'=>$data['remark'],'pid'=>0,'status'=>1);
                    $role_id=D('Role')->add_role($param);
                    $per=D('Node')->arr_list($data['node']);
                    $num=D('Access')->first_add($role_id);
                    $access_num=D('Access')->add_access($role_id,$per);
                    if($access_num>0 or $role_id>0){
                        echo json_encode(array('status'=>1,'data'=>'add','message'=>'添加角色成功'));
                    }else{
                        echo json_encode(array('status'=>0,'data'=>'add','message'=>'添加角色失败！请重试！'));
                    }
                }else{
                    echo json_encode(array('status'=>0,'data'=>'add','message'=>'必须有权限'));
                }

            }else{
                echo json_encode(array('status'=>0,'data'=>'add','message'=>'角色名必须有'));
            }
        }
    }
}
