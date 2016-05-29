<?php
/**
 * Created by PhpStorm.
 * User: lihh
 * Date: 2015/7/29
 * Time: 8:38
 */
namespace Home\Controller;
use Home\Util\Page;
use Think\Controller;
class AdminController extends CommonController{
    public function admin_index(){
        $data=intval(i('seek'));
        $page=intval(i('p'));
        $size=20;        
        if($page==0){
            $page=1;
        }
        $param['page']=$page;
        $param['data']=$data;
        if(empty($size)){
            json_return(0,'','size empty');
        }
        $param['size']=$size;
        $arr=D('Admin')->index($param);

        if($arr != null){
            $p=new Page($arr['count'],$size);
            $page_show=$p->show();
            $this->assign('page',$page_show);
            $this->assign('content',$arr['content']);
        }else{
            $this->error('系统错误！');
        }
        
//        $is1=file_get_contents(c('api_domain').'Admin/list_del_upd?url='.$_SERVER['PATH_INFO']);
//        $is2=json_decode($is1,true);
//        $name=$is2['data']['name'];
//        $sess=session('access');
//        $node=$sess['管理首页'][$name];
//        if(in_array($is2['data']['del']['id'],$node)){
//            $this->assign('del',1);
//        }
//        if(in_array($is2['data']['upd']['id'],$node)){
//            $this->assign('upd',1);
//        }
     
        $this->assign('title',array('one_title'=>'管理员管理','two_title'=>'管理员列表'));
        $this->display();
    }
    public function admin_add(){
        
        $m=file_get_contents(c('api_domain').'Admin/list_role');
        $ms=json_decode($m,true);
        
        $this->assign('content',$ms['data']);
        $this->assign('title',array('one_title'=>'管理员管理','two_title'=>'用户添加'));
        $this->display();
    }
    /**详情页面**/
    public function details(){
        $id=intval(i('id'));
        $d=file_get_contents(c('api_domain').'Admin/details?id='.$id);
        $ds=json_decode($d,true);
        $this->assign('details',$ds['data']);
        $rn=file_get_contents(c('api_domain').'Admin/list_role_user?id='.$id);
        $drn=json_decode($rn,true);
        $this->assign('role',$drn['data']);
        $m=file_get_contents(c('api_domain').'Admin/list_role');
        $ms=json_decode($m,true);
        $this->assign('content',$ms['data']);
        $u='http://'.$_SERVER['SERVER_NAME'];
        $r=$_SERVER['HTTP_REFERER'];
        $l=str_replace($u,'',$r);
        $url=str_replace('.html','',$l);
        $this->assign('url',$url);
        $this->assign('title',array('one_title'=>'管理员管理','two_title'=>'用户编辑'));
        $this->display('admin_add');
    }
    
    /**编辑Admin**/
    public function edit_admin(){
        $arr=i('post.');
        $id=intval($arr['id']);
        $array=array();
        foreach ($arr['role'] as $key=>$vo) {
            $array[$key]=intval($vo);
        }
        $arr['role']=$array;
        if(!empty($id)){
            /***修改**/
            if(!empty($arr['account'])){
                    if(!empty($arr['role'])){
                        $url = c('api_domain') . 'Admin/update_admin';
                        $res = post_json($arr, $url);
                        echo $res;
                    }else{
                        echo json_encode(array('status'=>0,'data'=>'update','message'=>'权限不能全部删除，如要删除，则删除管理员账号'));
                    }
            }else{
                echo json_encode(array('status'=>0,'data'=>'update','message'=>'用户名必须有'));
            }
        }else{
            /**添加**/
            if(!empty($arr['account'])) {
                if(!empty($arr['password']) and strlen($arr['password'])>5){
                    if($arr['password']==$arr['affirm_password']){
                        if(!empty($arr['role'])){
                            $url = c('api_domain') . 'Admin/add_admin';
                            $res = post_json($arr, $url);
                            echo $res;
                        }else{
                            echo json_encode(array('status'=>0,'data'=>'add','message'=>'权限不能为空'));
                        }

                    }else{
                        echo json_encode(array('status'=>0,'data'=>'add','message'=>'两次输入密码不相同'));
                    }

                }else{
                    echo json_encode(array('status'=>0,'data'=>'add','message'=>'密码不能为空或小于6位'));
                }

            }else{
                echo json_encode(array('status'=>0,'data'=>'add','message'=>'用户名必须有'));
            }
        }
    }
    
    /**删除Admin**/
    public function del_admin(){
        $id=intval(i('id'));
        $num=file_get_contents(c('api_domain').'Admin/del_admin?id='.$id);
        echo $num;
    }

    public function role_index(){
        $page=intval(i('p'));
        $size=20;
        $data=i('seek');
        $d=file_get_contents(c('api_domain').'Role/index?page='.$page.'&size='.$size.'&data='.$data);
        $arr=json_decode($d,true);
        $page=new Page($arr['data']['count'],$size);
        $page_show=$page->show();
        $this->assign('content',$arr['data']['content']);
        $this->assign('page',$page_show);
        $this->assign('title',array('one_title'=>'角色管理','two_title'=>'角色列表'));
        $this->display();
    }
    /**角色添加页面**/
    public function role_add(){
        $d=file_get_contents(c('api_domain').'Role/list_node');
        $arr=json_decode($d,true);
        $this->assign('first_list',$arr['data']['first']);
        $this->assign('second_list',$arr['data']['second']);
        $this->assign('title',array('one_title'=>'角色管理','two_title'=>'角色添加'));
        $this->display();
    }
   /**详情页面**/
    public function role_details(){
        $id=intval(i('id'));
        $s=file_get_contents(c('api_domain').'Role/list_role?id='.$id);
        $arr=json_decode($s,true);
        $this->assign('content',$arr['data']);
        $x=file_get_contents(c('api_domain').'Role/list_access?id='.$id);
        $ass=json_decode($x,true);
        $this->assign('node',$ass['data']);
        $d=file_get_contents(c('api_domain').'Role/list_node');
        $arr=json_decode($d,true);
        $this->assign('first_list',$arr['data']['first']);
        $this->assign('second_list',$arr['data']['second']);
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
        echo $d;
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
                    $url=c('api_domain').'Role/update_role';
                    $res=post_json($data,$url);
                    echo $res;
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
                    $url=c('api_domain').'Role/add_role';
                    $res=post_json($data,$url);
                    echo $res;
                }else{
                    echo json_encode(array('status'=>0,'data'=>'add','message'=>'必须有权限'));
                }

            }else{
                echo json_encode(array('status'=>0,'data'=>'add','message'=>'角色名必须有'));
            }
        }
    }

        public function dict_index(){
        $p = intval(i('p',1));
        $type=i('type');
        $name=i('name');
		$size=15;
        $data_json=file_get_contents(c('api_domain')."Dict/get_list?size=$size&page=$p&type=$type&name=$name");
        $json=json_decode($data_json,true);
		if($json["status"] ==1){
			$Page = new Page($json["data"]["count"],$size);
			$Page->parameter["type"]   =   urlencode($type);
			$Page->parameter["name"]   =   urlencode($name);
			$this->page = $Page->show();
			//字典type列表
			$dict_select=json_decode(file_get_contents(c('api_domain')."Dict/get_distinct"),true);
			$this->assign('dict_select',$dict_select["data"]);
			$this->assign('dict_list',$json["data"]["list"]);
			$this->assign('title',array('one_title'=>'数据字典设置','two_title'=>'数据字典列表'));
			$this->display();
		}else{
			$this->error("抱歉，系统出错！");
		}
    }
	
	public function dict_info(){
        $id=intval(i('id',0));
		if(empty($id)){
			$json=json_decode(file_get_contents(c('api_domain')."Dict/get_distinct"),true);
        	$this->assign('dict_select',$json["data"]);
			$this->assign('form_action',c('gl_domain').'Admin/add_dict');
			$this->assign('title',array('one_title'=>'数据字典设置','two_title'=>'添加数据字典'));
		}else{
			$json=json_decode(file_get_contents(c('api_domain').'Dict/get_info?id='.$id),true);
			$this->assign('dict',$json["data"]);
			$this->assign('form_action',c('gl_domain').'Admin/edit_dict');
			$this->assign('title',array('one_title'=>'数据字典设置','two_title'=>'编辑数据字典'));
		}
        $this->display();
    }
	
	public function add_dict(){
		$json=json_decode(post_json($_POST,c('api_domain').'DictA/do_add'),true);
		if($json['status'] ==1){
			$this->success($json["message"],u('Admin/dict_index'));
		}else{
			$this->error($json["message"],u('Admin/dict_info'));
		}
    }
	
	public function edit_dict(){
		$url = c('gl_domain').$_SESSION['page_http_referer'];
		$json=json_decode(post_json($_POST,c('api_domain').'Dict/do_edit'),true);
		if($json["status"] ==1){
			$this->success($json['message'],$url);
		}else{
			$this->error($json['message'],$url);
		}
    }
	
	/*删除*/
    public function del_dict(){
        $id=intval(i('id',0));
		echo file_get_contents(c('api_domain').'Dict/do_del?id='.$id);
    }
}