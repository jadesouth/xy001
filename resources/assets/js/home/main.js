/**
 * Created by xuying on 17/3/15.
 */
$('.navbar-toggle').on('click',function(){
    $(this).toggleClass('active').toggleClass('');
    if($(this).hasClass('active')){
        $('#navbar-collapse').addClass('active');
    } else{
        $('#navbar-collapse').removeClass('active');
    }
});
$('#header-pick-a-crate-link').on('click',function(){
    $(this).toggleClass('collapsed').toggleClass('');
    if($(this).hasClass('collapsed')){
        $(this).attr('aria-expanded',false);
        $('#dropdown-pick-crate').addClass('in');
    }else{
        $(this).attr('aria-expanded',true);
        $('#dropdown-pick-crate').removeClass('in');
    }
});
var str = '<div class="dropdown">' + '<button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">我的帐户<span class="caret"></span></button><ul class="dropdown-menu pull-left" aria-labelledby="dLabel"> <li class=""> <a href="">管理帐户</a></li> <li class=""><a href="#">退出登录</a></li></ul> </div>'
$(function () {
    $('#loginuser').on('click', function () {
        var user = $('#recipient-user').val();
        var pwd = $('#recipient-pwd').val();
//            console.log(user, pwd);
        if (user == "amazingfun@163.com" && pwd == "123456") {
            $("#loginmodal").modal('hide');
            $('.loginbtn').addClass('hidden');
            $('#header-my-account-link').removeClass('hidden');
            $("#loginaccount").removeClass('hidden');

        }
    });
    $('#logout,#loginout').on('click', function () {
        $('#header-my-account-link').addClass('hidden');
        $('#dropdown-account').attr('aria-expanded', false);
        $('#dropdown-account').removeClass('in');
        $('#header-log-in-modal-link').removeClass('hidden').show();
        $("#loginaccount").addClass('hidden');
        $('.loginbtn').removeClass('hidden');
    })
})