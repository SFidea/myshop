/**
 * Created by nihaiyang on 2015/6/30.
 */

var opena=jQuery('#sidebar .sub-menu > a').click(function () {
    var last = jQuery('.sub-menu.open', $('#sidebar'));
    last.removeClass("open");
    jQuery('.arrow', last).removeClass("open");
    jQuery('.sub', last).slideUp(200);
    var sub = jQuery(this).next();
    if (sub.is(":visible")) {
        jQuery('.arrow', jQuery(this)).removeClass("open");
        jQuery(this).parent().removeClass("open");
        sub.slideUp(200);
    } else {
        jQuery('.arrow', jQuery(this)).addClass("open");
        jQuery(this).parent().addClass("open");
        sub.slideDown(200);
    }
    var o = ($(this).offset());
    diff = 200 - o.top;
    if(diff>0)
        $("#sidebar").scrollTo("-="+Math.abs(diff),500);
    else
        $("#sidebar").scrollTo("+="+Math.abs(diff),500);
});

jQuery(function(){
	$(".sub-menu .sub li.active").parents('li.sub-menu').attr("id","open_munu");
	if($('#sidebar li#open_munu').length>0){
		$("li#open_munu").addClass("open");
		$("li#open_munu .arrow").addClass("open");
		$("li#open_munu .sub").slideDown(200);
	}
});


if($('#sidebar li#open_munu').length>0){
	$("li#open_munu").addClass("open");
	$("li#open_munu .arrow").addClass("open");
	$("li#open_munu .sub").slideDown(200);
}


/*导航*/
$('.nav-one > a').click(function(){
    $('.nav-er').slideUp();
    $('.nav-one').removeClass('active');
    var sub = $(this).next();
    console.log(sub.is(":visible"))
    if (!sub.is(":visible")) {
        sub.slideDown();
        sub.parent().addClass('active')
    }
})

$('.arrow').click(function(){
    $('aside').animate({
        left:-200
    },400);
    $('.main').animate({
        marginLeft:60
    })
})

$('.open').click(function(){
    $('aside').animate({
        left:0
    },400);
    $('.main').animate({
        marginLeft:200
    })
})


/*弹窗*/
$('body').append($('<div class="mask"></div>'));
$('.out').click(function(){
    $('.window-out,.mask').fadeIn();
    $('.close').click(function(){
        $('.window-out,.mask').fadeOut();
    })
})
function pypop(id){
    var obj=$(id);
    var l=($(window).width()-obj.width())/2+80;
    var t=($(window).height()-obj.height())/2+$(document).scrollTop()-120;
    obj.css({
        left:l,
        top:t
    })}
pypop('.window,.window-out')

function pypop2(id){
    var obj=$(id);
    var l=($(window).width()-obj.width())/2+80;
    var t=($(window).height()-obj.height())/2+$(document).scrollTop()-120;
    obj.css({
        left:l,
        top:t
    })}
pypop2('.window-active,.window-active2');
$(document).scroll(function(){
    pypop('.window,.window-out');
    pypop2('.window-active,.window-active2')
})



/*表格删除*/
$('.delete').click(function(){
    $('.window,.mask').fadeIn();
    var This= $(this);
    $('.table-del').click(function(){
        This.parent().parent().remove();
        $('.window,.mask').fadeOut();
    })
    $('.close').click(function(){
        $('.window,.mask').fadeOut();
    })
})

function del(obj){

    $('.window,.mask').fadeIn();
    var This=$(obj);
    /*$(obj).parent().parent().remove();*/
    $('.table-del').click(function(){
        This.parent().parent().remove();
        $('.window,.mask').fadeOut();
    })
    $('.close').click(function(){
        $('.window,.mask').fadeOut();
    })
}

/*数据字典*/
var name=$('#num-tab').find("option:selected").val();
/*$('#num-tab').find("option[text='education']").attr('selected','true');*/
/**/
$('#num-tab').change(function(){
    var name=$(this).find("option:selected").text();
    $('.num-name').val(name);
})


/* 活动设置*/
var play=$('.play').find('table');
play.hide();
play.eq(0).show()
$('.am-btn-group').find('button').click(function(){
    var num=($(this).index());
    $('.am-btn-group').find('button').attr('class','am-btn am-btn-default am-radius');
    $(this).attr('class','am-btn am-btn-primary am-radius');
    play.hide();
    play.eq(num).show()
})


/*活动设置-修改场次*/
var This=null;
/*$('.change-active').click(function(){
    This=$(this);
    $('.mask,.window-active').fadeIn();
    $('.close').click(function(){
        $('.mask,.window-active').fadeOut();
    })
    $('.num0').val($('.active-name').html());
    var time=This.parent().parent().find('.active-time').html().split('--');
    var name=This.parent().parent().find('.active-name').html();
    var number=This.parent().parent().find('.active-number').html().split('-');
    $('.time1').val(time[0]);
    $('.time2').val(time[1]);
    $('.num0').val(name);
    $('.num3').val(number[0]);
    $('.num4').val(number[1]);
})*/

function change(obj){
    This=$(obj);
    $('.mask,.window-active').fadeIn();
    $('.close').click(function(){
        $('.mask,.window-active').fadeOut();
    })
    $('.num0').val($('.active-name').html());
    var time=This.parent().parent().find('.active-time').html().split('--');
    var name=This.parent().parent().find('.active-name').html();
    var number=This.parent().parent().find('.active-number').html().split('-');
    $('.time1').val(time[0]);
    $('.time2').val(time[1]);
    $('.num0').val(name);
    $('.num3').val(number[0]);
    $('.num4').val(number[1]);
}

$('.active-true').click(function(){
    var name=$('.num0').val();
    var num1= $('.time1').val();
    var num2= $('.time2').val();
    var num3=$('.num3').val();
    var num4=$('.num4').val();
    console.log(name);
    var parent= This.parent().parent();
    parent.find('.active-time').html(num1+'~'+num2);
    parent.find('.active-name').html(name);
    parent.find('.active-number').html(num3+"~"+num4);
    $('.mask,.window-active').fadeOut();
})

$('.active-close').click(function(){
    $('.window-active,.mask').fadeOut()
})


/*活动设置-添加场次*/
$('.add-active').click(function(){
    $('#active-form2')[0].reset();
    $('.window-active2,.mask').fadeIn();


    $('.active-close2').click(function(){
        $('.window-active2,.mask').fadeOut();

    })
})
$('.active-true2').click(function(){
    var num1=$('.num02').val();
    var num2=$('.num32').val()+'~'+$('.num42').val();;
    var num3=$('.time12').val()+'~'+$('.time22').val();;
    var html='<tr><td></td><td class="active-name">'+num1+'</td>'+'<td class="active-number">'+num2+'</td>'+'<td class="active-time">'+num3+'</td>'+' <td><a class="am-btn am-btn-success am-btn-xs  change-active" onclick="change(this)" href="javascript:void(0);">修改</a><a class="am-btn am-btn-warning am-btn-xs delete" onclick="del(this)"  href="javascript:void(0);">删除</a></td> </tr>';
      if(num1==0||num2=="~"||num3=="~"){
        alert("请全部填写")
      }else{
          $('#active-table').append(html);
          $('.window-active2,.mask').fadeOut()
      }
})




 /*公众号管理*/

$('.add-number').click(function(){
    $('.number-add').find('em').fadeOut();
    var val=$('#number-select').val();
    if(val=='click'){
        if($('.add-click').val()==''){
            $('.add-click').next('em').fadeIn()
        }else{
            alert('添加')
        }
    }else if(val=='view'){
        if($('.add-view').val()==''){
            $('.add-view').next('em').fadeIn()
        }else{
            alert(2)
        }
    }

})
