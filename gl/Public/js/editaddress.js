$(document).ready(function(){
    var pid = $("#slt_province").attr("data-pid");
    if(pid == "def"){
        init("");
    }else{
        init(pid);
    }
    //退货地址
    var pid2 = $("#slt_province2").attr("data-pid");
    if(pid2 == "def")
    {
        init2("");
    }else{
        init2(pid2);
    }
})

function init(regid)
{
    $.ajax({
        type: "post",
        url: $("#gl_domain").val()+"brand/regionData",
        data:'{"action":"regionData","pid":"1"}',
        dataType: "json",
        success: function (data) {
            if(data.status==1)
            {
                $("#slt_province").empty();
                $.each(data.data,function(i, item) {
                    var slt_val = item.region_id;
                    var slt_txt = item.region_name;
                    $("#slt_province").append("<option value='"+slt_val+"'>"+slt_txt+"</option>");
                });

                $("#slt_province").change(function(){
                    getcity($(this).val());
                });

                if(regid!="")
                {
                    $("#slt_province").val(regid);
                }
                getcity($("#slt_province").val());
            }
            else
            {
                //数据获取失败
            }

        },
        complete: function(msg) {/*alert("complete:"+msg.responseText);*/ },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            /*alert("err:"+XMLHttpRequest.statusText);*/
        }
    });
}

function getcity(pid)
{
    $.ajax({
        type: "post",
        url: $("#gl_domain").val()+"brand/regionData",
        data:'{"action":"regionData","pid":'+pid+'}',
        dataType: "json",
        success: function (data) {
            if(data.status==1)
            {
                $("#slt_city").empty();
                $.each(data.data,function(i, item) {
                    var slt_val = item.region_id;
                    var slt_txt = item.region_name;
                    $("#slt_city").append("<option value='"+slt_val+"'>"+slt_txt+"</option>");
                });

                var data_pid = $("#slt_city").attr("data-pid");
                if(data_pid != "") {
                    $("#slt_city").val(data_pid);
                    $('#slt_city').attr('data-pid','');
                }
                getregion($("#slt_city").val());

                $("#slt_city").change(function(){
                    getregion($(this).val());
                });
            }
            else
            {
                //数据获取失败
            }

        },
        complete: function(msg) {/*alert("complete:"+msg.responseText);*/ },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            /*alert("err:"+XMLHttpRequest.statusText);*/
        }
    });
}


function getregion(pid)
{
    $.ajax({
        type: "post",
        url: $("#gl_domain").val()+"brand/regionData",
        data:'{"action":"regionData","pid":'+pid+'}',
        dataType: "json",
        success: function (data) {

            if(data.status==1)
            {
                $("#slt_region").empty();
                $.each(data.data,function(i, item) {
                    var slt_val = item.region_id;
                    var slt_txt = item.region_name;
                    $("#slt_region").append("<option value='"+slt_val+"'>"+slt_txt+"</option>");
                });

                var data_pid = $("#slt_region").attr("data-pid");
                if(data_pid != ""){
                    $("#slt_region").val(data_pid);
                    $('#slt_region').attr('data-pid','');
                }

            }
            else
            {
                //数据获取失败
            }

        },
        complete: function(msg) {/*alert("complete:"+msg.responseText);*/ },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            /*alert("err:"+XMLHttpRequest.statusText);*/
        }
    });
}



//退货地址

function init2(regid)
{
    $.ajax({
        type: "post",
        url: $("#gl_domain").val()+"brand/regionData",
        data:'{"action":"regionData","pid":"1"}',
        dataType: "json",
        success: function (data) {

            if(data.status==1)
            {
                $("#slt_province2").empty();
                $.each(data.data,function(i, item) {
                    var slt_val = item.region_id;
                    var slt_txt = item.region_name;
                    $("#slt_province2").append("<option value='"+slt_val+"'>"+slt_txt+"</option>");
                });

                $("#slt_province2").change(function(){
                    getcity2($(this).val());
                });

                if(regid!="")
                {
                    $("#slt_province2").val(regid);
                }
                getcity2($("#slt_province2").val());

            }
            else
            {
                //数据获取失败
            }

        },
        complete: function(msg) {/*alert("complete:"+msg.responseText);*/ },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            /*alert("err:"+XMLHttpRequest.statusText);*/
        }
    });
}

function getcity2(pid2)
{
    $.ajax({
        type: "post",
        url: $("#gl_domain").val()+"brand/regionData",
        data:'{"action":"regionData","pid":'+pid2+'}',
        dataType: "json",
        success: function (data) {

            if(data.status==1)
            {
                $("#slt_city2").empty();
                $.each(data.data,function(i, item) {
                    var slt_val = item.region_id;
                    var slt_txt = item.region_name;
                    $("#slt_city2").append("<option value='"+slt_val+"'>"+slt_txt+"</option>");
                });


                var data_pid2 = $("#slt_city2").attr("data-pid");

                if(data_pid2 != ""){

                    $("#slt_city2").val(data_pid2);
                    $('#slt_city2').attr('data-pid','');

                }



                getregion2($("#slt_city2").val());


                $("#slt_city2").change(function(){
                    getregion2($(this).val());
                });
            }
            else
            {
                //数据获取失败
            }

        },
        complete: function(msg) {/*alert("complete:"+msg.responseText);*/ },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            /*alert("err:"+XMLHttpRequest.statusText);*/
        }
    });
}


function getregion2(pid2)
{
    $.ajax({
        type: "post",
        url: $("#gl_domain").val()+"brand/regionData",
        data:'{"action":"regionData","pid":'+pid2+'}',
        dataType: "json",
        success: function (data) {

            if(data.status==1)
            {
                $("#slt_region2").empty();
                $.each(data.data,function(i, item) {
                    var slt_val = item.region_id;
                    var slt_txt = item.region_name;
                    $("#slt_region2").append("<option value='"+slt_val+"'>"+slt_txt+"</option>");
                });

                var data_pid2 = $("#slt_region2").attr("data-pid");
                if(data_pid2 != "") {
                    $("#slt_region2").val(data_pid2);
                    $('#slt_region2').attr('data-pid','');
                }
            }
            else
            {
                //数据获取失败
            }

        },
        complete: function(msg) {/*alert("complete:"+msg.responseText);*/ },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            /*alert("err:"+XMLHttpRequest.statusText);*/
        }
    });
}