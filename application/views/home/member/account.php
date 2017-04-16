<div class="main-content">
    <div data-hook="account_summary" class="account-summary">
        <div class="container"><h1 class="account-header">我的账户</h1>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation"><a id="account-menu-subscriptions-lnk" href="/member/order">我的订阅</a>
                </li>
                <li role="presentation" class="active"><a id="account-menu-account-info-lnk" href="/member/order">账户信息
                    </a></li>

            </ul>
            <br>
            <section><h2 class="account-header">账户信息</h2> <h4>个人资料</h4>

                <div class="row account-row">
                    <div class="col-md-3 col-xs-12 item-title">订阅日期</div>
                    <div class="col-md-7 col-xs-8 item-value"><?=date('Y-m',strtotime($user_info['created_at']))?></div>
                </div>
                <div class="row account-row">
                    <div class="col-md-3 col-xs-12 item-title">姓名</div>
                    <div class="col-md-7 col-xs-8 item-value"><?=$user_info['name']?></div>
                    <div class="col-md-2 col-xs-4 item-edit">
                        <a data-target="#namechange_modal" data-toggle="modal"
                           data-miss="modal" id="edit-name-modal-open-lnk"
                           href="#">编辑</a></div>
                </div>
                <div class="row account-row">
                    <div class="col-md-3 col-xs-12 item-title">Email</div>
                    <div class="col-md-7 col-xs-8 item-value"><?=$user_info['login_email']?></div>
                    <div class="col-md-2 col-xs-4 item-edit">
                        <a data-target="#emailchange_modal" data-toggle="modal"
                           data-miss="modal" id="edit-email-modal-open-lnk"
                           href="#">编辑</a></div>
                </div>
                <div class="row account-row">
                    <div class="col-md-3 col-xs-12 item-title">Password</div>
                    <div class="col-md-7 col-xs-8 item-value">************</div>
                    <div class="col-md-2 col-xs-4 item-edit">
                        <a data-target="#passwordchange_modal" data-toggle="modal"
                           data-miss="modal" id="edit-password-modal-open-lnk"
                           href="#">编辑</a></div>
                </div>
            </section>
            <div class="modal update fade" id="namechange_modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" id="namechange-modal-close-btn" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span></button>
                            <div class="cart-modal-title"><strong>修改姓名</strong></div>
                        </div>
                        <div class="modal-body">
                            <form action="" accept-charset="UTF-8" method="post">
                                <input name="utf8" type="hidden" value="✓">
                                <input type="hidden" name="_method" value="put">
                                <input type="hidden" name="authenticity_token" value="">

                                <div class="field">
                                    <input value="<?=$user_info['name']?>" type="text" name="user[full_name]" id="user_full_name"></div>
                                <input type="submit" name="commit" value="修改" id="namechange-modal-update-btn" class="btn btn-primary pull-left">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal update fade" id="emailchange_modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" id="emailchange-modal-close-btn" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                            <div class="cart-modal-title"><strong>电子邮箱</strong></div>
                        </div>
                        <div class="modal-body">
                            <form action="" accept-charset="UTF-8"
                                  method="post"><input name="utf8" type="hidden" value="✓">
                                <input type="hidden" name="authenticity_token" value="">

                                <div class="field">
                                    <input value="<?=$user_info['login_email']?>" type="text" name="user[email]" id="user_email"></div>
                                <input type="submit" name="commit" value="修改" id="emailchange-modal-update-btn"
                                       class="btn btn-primary pull-left"></form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal update fade" id="passwordchange_modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" id="passwordchange-modal-close-btn" data-dismiss="modal"> <span aria-hidden="true">&times;</span></button>
                            <div class="cart-modal-title"><strong>修改密码</strong></div>
                        </div>
                        <div class="modal-body">
                            <form action=""
                                  accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="✓"><input
                                    type="hidden" name="authenticity_token"
                                    value="">

                                <div class="field">
                                    <div class="field">旧密码</div>
                                    <input type="password" name="user[current_password]" id="user_current_password">

                                    <div class="field">新密码</div>
                                    <input type="password" name="user[password]" id="user_password">

                                    <div class="field">新密码确认</div>
                                    <input type="password" name="user[password_confirmation]"
                                           id="user_password_confirmation"></div>
                                <input type="submit" name="commit" value="修改" id="passwordchange-modal-update-btn"
                                       class="btn btn-primary pull-left"></form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/resources/assets/js/home/jquery.min.js"></script>
<script src="/resources/assets/js/home/swiper-3.4.0.jquery.min.js"></script>
<script src="/resources/assets/js/home/bootstrap.min.js"></script>
<script src="/resources/assets/js/home/main.js"></script>
<script>

    //    var str = '<div class="dropdown">' + '<button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">我的帐户<span class="caret"></span></button><ul class="dropdown-menu pull-left" aria-labelledby="dLabel"> <li class=""> <a href="">管理帐户</a></li> <li class=""><a href="#">退出登录</a></li></ul> </div>'
    //    $(function () {
    //        $('#loginuser').on('click', function () {
    //            var user = $('#recipient-user').val();
    //            var pwd = $('#recipient-pwd').val();
    ////            console.log(user, pwd);
    //            if (user == "amazingfun@163.com" && pwd == "123456") {
    //                $("#loginmodal").modal('hide');
    //                $('.loginbtn').addClass('hidden');
    //                $('#header-my-account-link').removeClass('hidden');
    //                $("#loginaccount").removeClass('hidden');
    //
    //            }
    //        });
    //        $('#logout,#loginout').on('click', function () {
    //            $('#header-my-account-link').addClass('hidden');
    //            $('#dropdown-account').attr('aria-expanded', false);
    //            $('#dropdown-account').removeClass('in');
    //            $('#header-log-in-modal-link').removeClass('hidden').show();
    //            $("#loginaccount").addClass('hidden');
    //            $('.loginbtn').removeClass('hidden');
    //        })
    //    })
</script>