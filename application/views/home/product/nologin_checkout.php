<style>

    .checkout-indicator {
        display: inline-block;
        float: left;
        margin: 30px 0 0 30px;
    }

    .panel-body {
        padding: 0;
    }

    .coupon-item {
        float: none;
        width: 100px;
    }

    .coupon-price {
        font-size: 30px;
    }

    #checkouts-steps .short-width input {
        display: inline-block;
        width: 15px;
    }

    #checkouts-steps .short-width .checkout_shipping_pay label {
        display: inline-block;
        width: 40px;
    }

    #checkouts-steps .short-width label.coupon {
        display: inline-block;
        width: 100px;
    }

    /*@media (min-width: 768px) {*/
    /*.all-crates .section-header {*/
    /*background-image: url("//images.contentful.com/rzwi86gxgpgo/4aCbftWO8oqiMiCsGK6eY8/7a3eb41c31a017b19659c7d07575dd6c/all-crates-hero.jpg");*/
    /*}*/

    /*.all-crates .section-listing .product-item.core-crate .img-container {*/
    /*background-image: url("//images.contentful.com/rzwi86gxgpgo/1A4CJMfj2UeS0cISwAc4gw/00ad7154acb8aaf3b7c5dc8bcbbe082d/all-crates-lootcrate.jpg");*/
    /*}*/
    /*}*/

    @media (max-width: 768px) {
        .all-crates .section-header .hero-mobile {
            display: block;
            max-width: 100%;
        }

        .all-crates .section-header .copy {
            max-width: 90%;
            text-align: center;
            margin: 0 auto;
            color: #333;
        }
    }

</style>
<div class="main-content">

    <div class="container">
        <div class="form-box col-sm-8 full-width">
            <div class="checkout-login-box" style="display: block">
                <div class="row-fluid existing-customer">
                    <div class="col-md-6 right-60">
                        <h3 class="text-center fw-400 bot-margin">我是一个新用户</h3>

                        <div class="text-center">
                            <p class="bot-margin">您将从最流行的文化中获得独家产品。</p>
                            <a id="checkout-continue-link" class="text-uppercase" data-target="#show-checkout-form"
                               href="#">继续作为新用户</a>
                        </div>
                    </div>
                    <div class="vr col-md-6 left-60"><h3 class="text-center fw-400 bot-margin">我有帐户</h3>

                        <div class="oldFormDiv" data-hook="signin">
                            <input name="utf8" type="hidden" value="✓">
                            <input type="hidden" name="authenticity_token" value="">

                            <div data-hook="signup_inside_form" class="staticForm">
                                <p><input class="title join required" tabindex="1" label="false"
                                          placeholder="邮箱" type="email" name="user[email]" id="user_email">
                                </p>

                                <div id="password-credentials">
                                    <p><input class="title join required" tabindex="2" label="false" placeholder="密码"
                                              type="password" name="user[password]" id="user_password"></p>
                                </div>
                                <p><input type="submit" name="commit" value="登录" class="btn btn-primary join"
                                          data-processing="processing..." id="login-submit-btn" tabindex="3"></p>

                                <div class="text-center">
                                    <p class="text-uppercase">
                                        <a id="login-modal-forgot-password-lnk" class="fw-600"
                                           href="/password">忘记密码?</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form class="simple_form card_form form-vertical form-validate" role="form" novalidate="novalidate"
                  id="new_checkout" data-token="ewr1-L5rk4DlD3XFPZUZOVdErvh" accept-charset="UTF-8" action="/product/nologin_pay" method="post">
                <input type="hidden" name="code" value="<?= $form_code?>">
                <input type="hidden" name="box_id" value="<?= $_GET['id'] ?>">
                <input type="hidden" name="plan" id="plan" value="<?=$_GET['plan']?>">
                <input type="hidden" name="tsize" id="option_type_shirt" value="<?=$_GET['tsize']?>">
                <div class="form-group hidden checkout_recurly_token">
                    <div class="controls">
<!--                        <input class="hidden" type="hidden" name="checkout[recurly_token]" id="checkout_recurly_token">-->
                    </div>
                </div>
<!--                <input value="1482469690-385362b9-ad0e-4480-9600-f1b7b7f760c1" type="hidden"-->
<!--                       name="checkout[transaction_id]" id="checkout_transaction_id">-->
<!--                <input type="hidden" name="secure_timestamp" id="secure_timestamp" value="1482469690">-->
<!--                <input type="hidden" name="secure_nonce" id="secure_nonce" value="Sx1fBJ5Mw7kzsD1rfe2f">-->
<!--                <input type="hidden" name="api_url" id="api_url" value="">-->
<!--                <input type="hidden" name="sku" id="sku" value="anime-crate">-->
<!--                <input type="hidden" name="current_country" id="current_country" value="CA">-->
<!--                <input value="CAD" type="hidden" name="checkout[currency]" id="checkout_currency">-->

                <div class="panel-group hide" id="accordion">
                    <div class="panel-content">
                        <div class="modal fade" id="crunchyrollModal" tabindex="-1" role="crunchyrolldialog"
                             aria-labelledby="crunchyrollModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <a href="#" data-dismiss="modal" aria-label="Close" class="close">
                                        <i class="fa fa-times-circle-o fa-3" aria-hidden="true"></i>
                                    </a>
                                    <div class="modal-header">
                                        <div class="col-xs-12 no-padding">
                                            <div class="cr-notice">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body" data-hook="login">
                                        <div class="loading">
                                            <iframe name="crunchy_login_iframe" width="100%" height="620px"></iframe>
                                        </div>
                                    </div>
                                    <div class="modal-footer"></div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default blocked" id="panel1">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="default-cursor panel-title collapse-link" data-toggle="collapse"
                                       data-parent="#accordion"
                                       href="#collapseSelect"><h3>我的订单</h3></a>

                                    <!--<div class="align-right edit-step hide"><a-->
                                    <!--class="btn btn-primary mobile-full-width edit-link" id="shipping-change-btn"-->
                                    <!--data-step="2" href="#">Change</a></div>-->
                                    <!--<div class="step-info">-->
                                    <!--<address></address>-->
                                    <!--</div>-->
                                </h4>
                            </div>
                            <div id="collapseSelect" class="panel-collapse in" data-step="2">
                                <div class="panel-body extra-margin-bot-15">
                                    <div class="row">
                                        <div class="col-md-12 hide" id="address-option">
                                            <ul id="shipping-options">
                                                <li id="new-address" class="col-xs-5 hide active-cell"><a
                                                            href="#newAddress" class="select-option-address active"
                                                            id="new-address-option" data-toggle="collapse"
                                                            data-parent="#accordion" aria-expanded="true"> <input
                                                                type="radio" name="shipping-option"
                                                                id="shipping-option_new-address" value="new-address"
                                                                class="address-option hidden" data-toggle="collapse"
                                                                data-parent="#accordion" data-href="#newAddress">
                                                        <!--<img src="https:/assets/add_address_icon-49446a00d3037a706f58c41aa9979e798252d64c84cd99f67641607a36f1df5c.png">-->
                                                        <span> ADD NEW ADDRESS </span> </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div id="newAddress" class="col-sm-12 panel-collapse collapse in" aria-expanded="true">
                                    <div class="panel-body">
                                        <div class="">
                                            <p style="color:#ccc;margin: 0">请您填写邮箱和密码，它将作为您登录账户的帐号</p>
                                            <div class="row">
                                                <div class="col-xs-6 full-width mobile-col-padding-right">
                                                    <div class="form-group string required checkout_shipping_name">
                                                        <label class="string required control-label"
                                                               for="checkout_shipping_address_first_name"
                                                               style="opacity: 0">
                                                            邮箱<abbr title="required">*</abbr></label>
                                                        <div class="controls"><input class="string required"
                                                                                     placeholder="邮箱" type="text"
                                                                                     name="post_email"
                                                                                     id="checkout_shipping_address_first_name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 full-width mobile-col-padding-right">
                                                    <div class="form-group string required checkout_shipping_name">
                                                        <label class="string required control-label"
                                                               for="checkout_shipping_address_first_name"
                                                               style="opacity: 0">
                                                            密码<abbr title="required">*</abbr></label>
                                                        <div class="controls"><input class="string required"
                                                                                     placeholder="密码" type="password"
                                                                                     name="password"
                                                                                     id="checkout_shipping_address_first_name">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="row">
                                                    <div class="col-xs-12 full-width mobile-col-padding-right">
                                                        <div class="form-group string required checkout_shipping_name">
                                                            <label class="string required control-label"
                                                                   for="checkout_shipping_address_first_name"
                                                                   style="opacity: 0">
                                                                姓名<abbr title="required">*</abbr></label>
                                                            <div class="controls"><input class="string required"
                                                                                         placeholder="姓名" type="text"
                                                                                         name="post_name"
                                                                                         id="checkout_shipping_address_first_name">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 full-width">
                                                        <div class="form-group string required checkout_shipping_tel">
                                                            <label class="string required control-label"
                                                                   for="checkout_shipping_address_line_1"
                                                                   style="opacity: 0">电话<abbr title="required">*</abbr></label>

                                                            <div class="controls">
                                                                <input class="string required" placeholder="电话"
                                                                       type="text"
                                                                       name="post_phone"
                                                                       id="checkout_shipping_address_line_1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 full-width">
                                                        <div class="form-group string optional checkout_shipping_address_line">
                                                            <label class="string optional control-label"
                                                                   for="checkout_shipping_address_line"
                                                                   style="opacity: 0;">送货地址</label>
                                                            <div class="controls">
                                                                <input class="string optional" placeholder="送货地址"
                                                                       type="text"
                                                                       name="post_addr"
                                                                       id="checkout_shipping_address_line">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="row">
                                                <div class="col-md-12 full-width">
                                                    <div class="form-group string optional checkout_shipping_answer">
                                                        <label class="string optional control-label" for="checkout_shipping_answer" style="opacity: 0;">留言</label>
                                                        <div class="controls">
                                                            <input class="string optional"placeholder="网络解忧杂货店键入您遇到的烦恼和问题" type="text" name="leave_word" id="checkout_shipping_answer">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="row">
                                                    <div class="col-md-12 short-width">
                                                        <div class="form-group string optional checkout_shipping_pay">
                                                            <span>选择支付方式：</span>
                                                            <input type="radio" class="" id="pay1-btn" name="payway" value="alipay" checked>
                                                            <label for="pay1-btn">
                                                                <img src="/resources/assets/images/alipay.png" alt=""/>
                                                            </label>
                                                            <input type="radio" class="" id="pay2-btn" name="payway" value="wxpay">
                                                            <label for="pay2-btn">
                                                                <img src="/resources/assets/images/wechatpay.png"
                                                                     alt=""/>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="controls align-left next_step">
                                        <button
                                                class="btn btn-primary mobile-full-width next"
                                                id="shipping-continue-btn">支付
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sticky-content checkout col-sm-4">
                    <div id="sub-details"><h3>订单汇总 </h3>

                        <div class="summary-receipt">
                            <div class="center-block coSumImage higher-z">
                                <img class="img-responsive" src="<?= $box_info['logistics_image'] ?>"
                                     alt="Checkout summary">
                            </div>
                            <div id="cosummaryright" class="coSumBox">
                                <div id="cosummarypricebreakdown">
                                    <div class="row item-title">
                                        <div class="col-xs-7 no-right-padding"><b><?= $box_info['theme_name'] ?></b>
                                        </div>
                                        <div class="col-xs-5"><b><span>¥<?= $price ?></span></b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-7 no-right-padding"><?=$plan?>个月订阅</div>
                                        <div class="col-xs-5"></div>
                                    </div>
                                    <?php if (! empty($t_shirt_size)): ?>
                                        <div class="row">
                                            <div class="col-xs-12">T-shirt: <?= $t_shirt_size ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="row subcription-month">
                                        <div class="col-xs-12 no-right-padding">
                                            <span>¥<?=$box_info['monthly_price']?></span>／每月(包含运费)
                                        </div>
                                        <!--<div class="col-xs-5"></div>-->
                                    </div>
<!--                                    <div class="row subscription-coupon">-->
<!--                                        <div class="col-xs-9 no-right-padding ">-->
<!--                                            <div class="subscription-coupon-text" data-text="Coupon">优惠券</div>-->
<!--                                        </div>-->
<!--                                        <div class="col-xs-3 no-left-padding">-->
<!--                                            <span class="subscription-coupon" id="coupon-discount-amount">¥0.00</span>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                    <hr class="checkout-hr">
                                    <div class="subscription-subtotal">
                                        <div class="row">
                                            <div class="col-xs-9 no-right-padding subtotal-amount"><b>小计</b></div>
                                            <div class="col-xs-3 no-left-padding subtotal-amount"><span
                                                        id="subscription-subtotal"> <b><span>¥<?= $price ?></span></b> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="checkout-hr">
                                    <div class="row">
                                        <div class="col-xs-9 no-right-padding total-amount"><b>总计</b></div>
                                        <div class="col-xs-3 no-left-padding total-amount"><span
                                                    id="subscription-today-total"> <b><span>¥<?= $price ?></span><span></span></b> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="secure-header row">
                        <div class="secure"><b><i class="fa fa-lock fa-2"></i> 安全结账</b><br>
                            我们的结帐是安全和放心的。您的个人和支付信息是通过256位安全传输加密。
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
    $(function () {
        $('#login-submit-btn').on('click', function () {
            var email = $('#user_email').val();
            var pwd = $('#user_password').val();
            $.ajax({
                type: "POST",
                url: "/user/ajax_login",
                data: {"email": email, "password": pwd},
                dataType: "json",
                success: function (response) {
                    if (0 == response.status) {
                        layer.msg(response.msg, {icon: 6, time: 1000}, function () {
                            window.location.reload();
                        });
                    } else if (1 == response.status) {
                        layer.alert(response.msg, {icon: 2});
                        return false;
                    }
                }
            });
        });
//        $('#shipping-continue-btn').on('click', function () {
//            $.ajax({
//                type: "POST",
//                url: "/product/pay/nologin",
//                data: $("#new_checkout").serialize(),
//                dataType: "json",
//                success: function (response) {
//                    if (0 == response.status) {
//                        layer.msg(response.msg, {icon: 6, time: 1000}, function () {
//                            window.location.reload();
//                        });
//                    } else if (1 == response.status) {
//                        layer.alert(response.msg, {icon: 2});
//                        return false;
//                    }
//                }
//            });
//        });
        $('#checkout-continue-link').click(function () {
            $('.checkout-login-box').hide();
            $('#accordion').removeClass('hide');
        })
    })


</script>