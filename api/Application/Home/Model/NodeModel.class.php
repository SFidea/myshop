<?php
/**
 * Created by PhpStorm.
 * User: lihh
 * Date: 2015/7/24
 * Time: 17:23
 */
namespace Home\Model;

use Think\Model;

class NodeModel extends Model
{
    protected $tableName = 'think_node';
    /**
     * 后台左侧菜单栏，一级菜单列表
     * @author yaoyu 16/5/28
     */
    public function readFirstNode()
    {
        $node = M('think_node');
        $first_list = $node->field('id,name,title')->where('is_show=1 and pid=1')->order('sort asc,id asc')->select();
        return  $first_list;
    }

    /**
     * 后台左侧菜单栏，根据一级ID查询二级菜单列表
     * @author 张芝汇 16/3/8
     */
    public function readSecondNode($id)
    {
        $node = M('think_node');
        $second_list = $node->field('id,name,title,url')->where('is_show=1 and pid='.$id)->order('sort asc,id asc')->select();
        return  $second_list;
    }

    /**
     * 根据菜单id查询菜单列表
     * @author yaoyu 16/5/28
     */
    public function readNode($id){
        $info = M('think_node')->field('id,name,pid,title,url')->where('is_show=1 and id='.$id)->find();
        return $info;
    }

    public function index(){
        $m=M();
        $sql='select id,name,title from ecs_think_node where pid=1';
        $first=$m->query($sql);
        $sql1='select b.id,b.name,b.url,b.pid,b.title from (select id,name,title from ecs_think_node where pid=1) as a left join ecs_think_node as b on a.id=b.pid';
        $second=$m->query($sql1);
        return array('first'=>$first,'second'=>$second);
    }
   
    public function index_left(){
        $m=M();
        $sql='select id,name,title from ecs_think_node where pid=1 and is_show=1';
        $first=$m->query($sql);
        $sql1='select b.id,b.name,b.url,b.pid,b.title from (select id,name,title from ecs_think_node where pid=1) as a left join ecs_think_node as b on a.id=b.pid where is_show=1';
        $second=$m->query($sql1);
        return array('first'=>$first,'second'=>$second);
    }

    /**根据ID查**/
    public function list_node($id){
        $arr= M('think_node')->field('name,pid,url,id,title')->where('is_show=1 and id='.$id)->find();
        return $arr;
    }
    
    /**多ID查询**/
    public function arr_list($data){
        $map['id']=array('in',$data);
        $arr=M('think_node')->field('id,pid,level')->where($map)->select();
        return $arr;
    }
}