/**
 * Created by wxd on 2015/9/2.
 */
$(document).ready(function(){
    ActivityList();
    ListDel();
    ClearModal();
    ListModify();
    ActivityAdd();
    add_event();
});
function ActivityAdd(){
    $('#activity_add').click(function(){
        $('#activity_add_sub').attr('data-save','1');
    })
}
function ActivityList(){
    $('#activity_add_sub').on('click',function(){
        var datasave=$('#activity_add_sub').attr('data-save');
        var $activity_name= $.trim($('#activity_name').val()),
            $activity_id= $.trim($('#activity_id').val());
            $start_h=$('#start_h').find('option:selected').text(),
            $start_m=$('#start_m').find('option:selected').text(),
            $start_s=$('#start_s').find('option:selected').text(),
            $end_h=$('#end_h').find('option:selected').text(),
            $end_m=$('#end_m').find('option:selected').text(),
            $end_s=$('#end_s').find('option:selected').text(),
            $activity_start=$.trim($('#activity_start').val()),
            $activity_end=$.trim($('#activity_end').val()),
            $activity_list_tbody=$('#activity_list_tbody');
        if($activity_id==''){
            $activity_id=0;
        }
        var htmlObj='';
        var $time=$start_h+':'+$start_m+':'+$start_s+'~'+$end_h+':'+$end_m+':'+$end_s;
        var $num=$activity_start+'~'+$activity_end;
        htmlObj='<td>'+$activity_id+'</td>'+'<td>'+$activity_name+'</td>'+'<td>'+$num+'</td>'+'<td>'+$time+'</td>'+'<td>'+'<button type="button" class="btn btn-primary btn_modify">修改</button> <button type="button" class="btn btn-default btn-del">删除</button>'+'</td>';
        if($activity_name!='' && $activity_name.length<6){
            $('#myModal').modal('hide');
            if(datasave==1){
                $('#activity_list').show();
                $activity_list_tbody.append('<tr>'+htmlObj+'</tr>');
            }else{
                var $tr=$('#activity_list_tbody tr[data-modify="1"]');
                $tr.empty().append(htmlObj);

                $tr.attr('data-modify','2');
            }
        }else{
            alert('您还有信息未填写完整或不符合规范，请重新输入！')
        }

    });

}
//修改按钮
function ListModify(){
    $(document).on('click','.btn_modify',function(){
        $('#activity_add_sub').attr('data-save','2');
        var idx=$(this).index('.btn_modify');
        var $tr=$('#activity_list_tbody tr').eq(idx);
        $tr.attr('data-modify','1');
        var valArr=[];
        $tr.find("td").each(function(){
            valArr.push($.trim($(this).text()));//.text()获取td的文本内容，$.trim()去空格
        });
        var id=valArr[0];
        var name=valArr[1];
        var activity_start=valArr[2].split('~');
        var alltime=valArr[3];
        var time=alltime.split(':');
        var timetwo=time[2].split('~');
        $('#activity_id').val(id);
        $('#activity_name').val(name);
        $('#activity_start').val(activity_start[0]);
        $('#activity_end').val(activity_start[1]);
        $('#start_h').val(time[0]);
        $('#start_m').val(time[1]);
        $('#start_s').val(timetwo[0]);
        $('#end_h').val(timetwo[1]);
        $('#end_s').val(time[3]);
        $('#end_m').val(time[4]);
        $('#myModal').modal('show');
    })
}

//清除弹出框内容
function ClearModal(){
    $('#myModal').on('hidden.bs.modal', function () {
        $('#activity_name').val('');
        $('#activity_start').val('');
        $('#activity_end').val('');
        $('#start_h').val('01');
        $('#start_m').val('01');
        $('#start_s').val('01');
        $('#end_h').val('01');
        $('#end_s').val('01');
        $('#end_m').val('01');
    })
}

//删除一行
function ListDel(){
    $(document).on('click','.btn-del',function(){
        var idx=$(this).index('.btn-del');
        var trl=$('#activity_list_tbody tr').length;
        $('#activity_list_tbody tr').eq(idx).remove();
        if(trl==1){
            $('#activity_list').hide(1000);
        }
    })
}
function add_event(){
    $('#add_event').on('click',function(){
        var ronda_list_arr=[];
        $("#active-table").find("tr").each(function(index,data){
            var ronda={};
            $(data).find("td").each(function(i,d){
                ronda[i]=($.trim($(this).text()));//.text()获取td的文本内容，$.trim()去空格
            });
            ronda_list_arr.push(ronda);
        });
        var ronda_list = JSON.stringify(ronda_list_arr);
        $("#ronda_list").val(ronda_list);
        var event_name=$('#event_name').val();
        var event_describe=$('#event_describe').val();
        var type=$('#type').val();
        var img_event=$('img_event').val();
        if(event_name==''){
            alert('活动名称不能为空！');
            return;
        }
        if(event_name.length>6 ){
            alert('活动名称不能大于6个字长度！');
            return;
        }
        if(event_describe==''){
            alert('活动描述不能为空！');
            return;
        }
        if(event_describe.length>50 ){
            alert('活动描述不能大于50个字长度！');
            return;
        }
        if(type==''){
            alert('活动类型必须选择！');
            return;
        }
        if(img_event==''){
            alert('活动图片必须上传！');
            return;
        }
        if(ronda_list==""){
            alert('活动场次必须有1场或以上！');
            return;
        }

        document.addForm.submit();
    })
}
$(function(){
    $('#event_name').blur(function(){
        var event_name=$(this).val();
        if(event_name==''){
            alert('活动名称不能为空');
            return;
        }
        if(event_name.length>6 ){
            alert('活动名称不能大于6个字长度！');
            return;
        }
    })
});
$(function(){
    $('#event_describe').blur(function(){
        var event_describe=$(this).val();
        if(event_describe==''){
            alert('活动描述不能为空');
            return;
        }
        if(event_describe.length>50 ){
            alert('活动描述不能大于50个字长度！');
            return;
        }
    })
});
$(function(){
    $("input[type=checkbox]").click(function(){
        var val= $(this).attr('tag');
        $(this).attr('checked','checked');
        $(this).parent().siblings().find('input[type=checkbox]').removeAttr("checked");
        $('#type').val(val);
    });
});

