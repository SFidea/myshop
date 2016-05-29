/**
 * Created by lihh on 2015/9/22.
 */
$(document).ready(function(){
    Select();
});
function Select(){
    $('#event').change(function(){
        var x=$(this).val();
        $.ajax({
            type: "post",
            url: $('#gl_domain').val()+'EventCheck/checkRonda',
            data:{event_id:x},
            dataType: "json",
            success:function(data){
                $("#ronda").empty().append("<option selected = 'selected' value='0'>"+"全部场次"+"</option>");
                $.each(data.data,function(i, item) {
                    var slt_val = item.id;
                    var slt_txt = item.ronda_name;
                    $("#ronda").append("<option value='"+slt_val+"'>"+slt_txt+"</option>");
                });
            }
        })
    })
}

