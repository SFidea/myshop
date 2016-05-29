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
pypop('.window,.window-out,.window-password')

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

/*$('.delete').click(function(){
    $('.window,.mask').fadeIn();
    var This= $(this);
    $('.table-del').click(function(){
        This.parent().parent().remove();
        $('.window,.mask').fadeOut();
    })
    $('.close').click(function(){
        $('.window,.mask').fadeOut();
    })
})*/

$(document).on('click','.delete',function(){
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

/*function del(obj){

    $('.window,.mask').fadeIn();
    var This=$(obj);
    /!*$(obj).parent().parent().remove();*!/
    $('.table-del').click(function(){
        This.parent().parent().remove();
        $('.window,.mask').fadeOut();
    })
    $('.close').click(function(){
        $('.window,.mask').fadeOut();
    })
}*/

var name=$('#num-tab').find("option:selected").val();
/*$('#num-tab').find("option[text='education']").attr('selected','true');*/
/**/
$('#num-tab').change(function(){
    var name=$(this).find("option:selected").text();
    $('.num-name').val(name);
})

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

var This=null;

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
    var num1= $('.time1').val()+":00";
    var num2= $('.time2').val()+":00";
    var num3=$('.num3').val();
    var num4=$('.num4').val();
    console.log(name);
    var parent= This.parent().parent();
    parent.find('.active-time').html(num1+'--'+num2);
    parent.find('.active-name').html(name);
    parent.find('.active-number').html(num3+"-"+num4);
    $('.mask,.window-active').fadeOut();
})

$('.active-close').click(function(){
    $('.window-active,.mask').fadeOut()
})


$('.add-active').click(function(){
    $('#active-form2')[0].reset();
    $('.window-active2,.mask').fadeIn();


    $('.active-close2').click(function(){
        $('.window-active2,.mask').fadeOut();

    })
})
$('.active-true2').click(function(){
    var num1=$('.num02').val();
    var num2=$('.num32').val()+'-'+$('.num42').val();
    var val=$('.time12').val();
    var val2=$('.time22').val();

    var num3=val+':00'+"--"+val2+':00';

    var html='<tr><td>33</td><td class="active-name">'+num1+'</td>'+'<td class="active-number">'+num2+'</td>'+'<td class="active-time">'+num3+'</td>'+' <td><a class="am-btn am-btn-success am-btn-xs  change-active" onclick="change(this)" href="javascript:void(0);">�޸�</a><a class="am-btn am-btn-warning am-btn-xs delete" onclick="del(this)"  href="javascript:void(0);">ɾ��</a></td> </tr>';
      if(num1==0||num2=="-"||num3=="--"){
        alert("��ȫ����д")
      }else{
          $('#active-table').append(html);
          $('.window-active2,.mask').fadeOut()
      }
})

$('.add-number').click(function(){
    $('.number-add').find('em').fadeOut();
    var val=$('#number-select').val();
    if(val=='click'){
        if($('.add-click').val()==''){
            $('.add-click').next('em').fadeIn()
        }else{
            alert('���')
        }
    }else if(val=='view'){
        if($('.add-view').val()==''){
            $('.add-view').next('em').fadeIn()
        }else{
            alert(2)
        }
    }
})

$('.admin-re').click(function(){
    $('.mask,.window-password').fadeIn();
    $('.close').click(function(){
        $('.mask,.window-password').fadeOut();
        $('.password-true').click(function(){
            $('.mask,.window-password').fadeOut();
        })
    })
})


$('.san').click(function(){
    $(this).parent().next('.user-hide').slideToggle()
})



