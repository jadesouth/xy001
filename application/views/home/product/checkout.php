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

    #checkouts-steps .short-width label {
        display: inline-block;
        width: 50px;
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

            <form class="simple_form card_form form-vertical form-validate" role="form" novalidate="novalidate"
                  id="new_checkout" data-token="ewr1-L5rk4DlD3XFPZUZOVdErvh"
                  action="/product/pay" accept-charset="UTF-8" method="post">
                <input type="hidden" name="user_id" value="<?= $user_info['id'] ?>">
                <input type="hidden" name="box_id" value="<?= $_GET['id'] ?>">
                <input type="hidden" name="plan" id="plan" value="<?= $_GET['plan'] ?>">
                <input type="hidden" name="tsize" id="option_type_shirt" value="<?= $_GET['tsize'] ?>">
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

                <div class="panel-group " id="accordion">
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
                                       href="#collapseSelect"><h3>送货地址 </h3></a>

                                    <div class="align-right edit-step hide"><a
                                                class="btn btn-primary mobile-full-width edit-link"
                                                id="shipping-change-btn"
                                                data-step="2" href="#">Change</a></div>
                                    <div class="step-info">
                                        <address></address>
                                    </div>
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
                                        <div class="row">
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
                                                                                     id="checkout_shipping_address_first_name"
                                                                                     value="<?= $user_info['post_name'] ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 full-width">
                                                    <div class="form-group string required checkout_shipping_tel">
                                                        <label class="string required control-label"
                                                               for="checkout_shipping_address_line_1"
                                                               style="opacity: 0">电话<abbr
                                                                    title="required">*</abbr></label>

                                                        <div class="controls">
                                                            <input class="string required" placeholder="电话" type="text"
                                                                   name="post_phone"
                                                                   id="checkout_shipping_address_line_1"
                                                                   value="<?= $user_info['post_phone'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 full-width">
                                                    <div class="form-group string optional checkout_shipping_address_line">
                                                        <label class="string optional control-label"
                                                               for="checkout_shipping_address_line" style="opacity: 0;">送货地址</label>
                                                        <div class="controls">
                                                            <input class="string optional" placeholder="送货地址"
                                                                   type="text" name="post_addr"
                                                                   id="checkout_shipping_address_line"
                                                                   value="<?= $user_info['post_addr'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if(!empty($coupons)) :?>
                                            <div class="row">
                                                <div class="col-md-12 short-width">
                                                    <span>选择优惠券：</span>
                                                    <?php foreach($coupons as $coupon) :?>
                                                    <div class="form-group string optional checkout_shipping_pay coupon_list radio">

                                                        <input type="radio" class="" name="coupon" value="<?=$coupon['id']?>" id="coupon-<?=$coupon['id']?>">
                                                        <label for="coupon-<?=$coupon['id']?>" class="coupon">
                                                            <div class="coupon-item ">
                                                                <div class="coupon-up">
                                                                    <p class="coupon-left">
                                                                        <span class="coupon-a">¥</span>
                                                                        <span class="coupon-price"><?=$coupon['value']?></span>
                                                                        <span class="coupon-title">优惠券</span>
                                                                    </p>
                                                                    <p class="text-center coupon-time">
                                                                        <?=date('Y-m-d',strtotime($coupon['created_at']))?>-<?=$coupon['expiration_time']?></p>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <?php endforeach;?>
                                                </div>
                                            </div>
                                            <?php endif;?>
                                            <div class="row">
                                                <div class="col-md-12 short-width">
                                                    <div class="form-group string optional checkout_shipping_pay">
                                                        <span>选择支付方式：</span>
                                                        <input type="radio" class="" id="pay1-btn" name="payway"
                                                               value="alipay">
                                                        <label for="pay1-btn">
                                                            <img src="/resources/assets/images/alipay.png" alt=""/>
                                                        </label>
                                                        <input type="radio" id="pay2-btn" name="payway">
                                                        <label for="pay2-btn">
                                                            <img src="/resources/assets/images/wechatpay.png" alt=""/>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="controls align-left next_step">
                                    <button type="submit" class="btn btn-primary mobile-full-width next"
                                            id="shipping-continue-btn">支付
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="sticky-content checkout col-sm-4">
            <div id="sub-details"><h3>订单汇总 </h3>

                <div class="summary-receipt">
                    <div class="center-block coSumImage higher-z">
                        <img class="img-responsive" src="/resources/assets/images/box.png" alt="Checkout summary">
                    </div>
                    <div id="cosummaryright" class="coSumBox">
                        <div id="cosummarypricebreakdown">
                            <div class="row item-title">
                                <div class="col-xs-7 no-right-padding"><b><?= $box_info['theme_name'] ?></b></div>
                                <div class="col-xs-5"><b><span>¥<span id="price"><?= $price ?></span></span></b></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-7 no-right-padding"><?= $plan ?>个月订阅</div>
                                <div class="col-xs-5"></div>
                            </div>
                            <?php if (! empty($t_shirt_size)): ?>
                                <div class="row">
                                    <div class="col-xs-12">T-shirt: <?= $t_shirt_size ?></div>
                                </div>
                            <?php endif; ?>
                            <div class="row subcription-month">
                                <div class="col-xs-12 no-right-padding">
                                    <span>¥<?= $box_info['monthly_price'] ?></span>／每月(包含运费)
                                </div>
                                <!--<div class="col-xs-5"></div>-->
                            </div>
                            <div class="row">
                                <div class="col-xs-12">2017年1月10日第一次续约</div>
                                <!--<div class="col-xs-3"></div>-->
                            </div>
                            <div class="row subscription-coupon">
                                <div class="col-xs-9 no-right-padding ">
                                    <div class="subscription-coupon-text" data-text="Coupon">优惠券</div>
                                </div>
                                <div class="col-xs-3 no-left-padding">
                                    <span class="subscription-coupon" id="coupon-discount-amount">¥0.00</span>
                                </div>
                            </div>
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
                                <div class="col-xs-3 no-left-padding total-amount"><span id="subscription-today-total"> <b><span>¥<?= $price ?></span><span></span></b> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="secure-header row">
                <div class="secure"><b><i class="fa fa-lock fa-2"></i> 安全结账</b><br> 我们的结帐是安全和放心的。您的个人和支付信息是通过256位安全传输加密。
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

        $('#checkout-continue-link').click(function () {
            $('.checkout-login-box').hide();
            $('#accordion').removeClass('hide');
        })

        $('.coupon_list').click(function () {
            var coupon_price = $(this).find('.coupon-price').html();
            $('#coupon-discount-amount').text('¥'+coupon_price);
            var total_price = $('#price').text() - coupon_price;
            $('#subscription-today-total').text('¥'+total_price);
        })
    })


</script>