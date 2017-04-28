<style>
    .checkout-indicator {
        display: inline-block;
        float: left;
        margin: 30px 0 0 30px;
    }
    .panel-body{
        padding:0;
    }
    .coupon-item{
        float:none;
        width:100px;
    }
    .coupon-price {
        font-size: 30px;
    }
    #checkouts-steps .short-width input{
        display:inline-block;
        width:15px;
    }
    #checkouts-steps .short-width .checkout_shipping_pay label{
        display:inline-block;
        width:40px;
    }
    #checkouts-steps .short-width label.coupon {
          display:inline-block;
          width:100px;
    }
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
            <form class="simple_form card_form form-vertical form-validate" role="form" novalidate="novalidate" id="new_checkout" action="<?=base_url('order/upgradePay')?>" accept-charset="UTF-8" method="post">
                <input name="order" type="hidden" value="<?=$order['id']?>">
                <div class="panel-group " id="accordion">
                    <div class="panel-content">
                        <div class="modal fade" id="crunchyrollModal" tabindex="-1" role="crunchyrolldialog" aria-labelledby="crunchyrollModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <a href="#" data-dismiss="modal" aria-label="Close" class="close">
                                        <i class="fa fa-times-circle-o fa-3" aria-hidden="true"></i>
                                    </a>
                                    <div class="modal-header">
                                        <div class="col-xs-12 no-padding">
                                            <div class="cr-notice"></div>
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
                                    <a class="default-cursor panel-title collapse-link" data-toggle="collapse" data-parent="#accordion" href="#collapseSelect">
                                        <h3>送货地址 </h3>
                                    </a>
                                    <div class="align-right edit-step hide">
                                        <a class="btn btn-primary mobile-full-width edit-link" id="shipping-change-btn" data-step="2" href="#">Change</a>
                                    </div>
                                    <div class="step-info">
                                        <address></address>
                                    </div>
                                </h4>
                            </div>
                            <div id="collapseSelect" class="panel-collapse in" data-step="2">
                                <div id="newAddress" class="col-sm-12 panel-collapse collapse in" aria-expanded="true">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-xs-12 full-width mobile-col-padding-right">
                                                    <div class="form-group string required checkout_shipping_name">
                                                        <label class="string required control-label" for="post_name" style="opacity: 0">姓名
                                                            <abbr title="required">*</abbr>
                                                        </label>
                                                        <div class="controls">
                                                            <input value="<?=$order['post_name']?>" class="string required" placeholder="姓名" type="text" name="post_name" id="post_name">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 full-width">
                                                    <div class="form-group string required checkout_shipping_tel">
                                                        <label class="string required control-label" for="post_phone" style="opacity: 0">电话<abbr title="required">*</abbr></label>
                                                        <div class="controls">
                                                            <input value="<?=$order['post_phone']?>" class="string required" placeholder="电话" type="text" name="post_phone" id="post_phone">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 full-width">
                                                    <div class="form-group string optional checkout_shipping_address_line">
                                                        <label class="string optional control-label" for="post_addr" style="opacity: 0;">送货地址</label>
                                                        <div class="controls">
                                                            <input value="<?=$order['post_addr']?>" class="string optional" placeholder="送货地址" type="text" name="post_addr" id="post_addr">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 short-width">
                                                    <div class="form-group string optional checkout_shipping_pay">
                                                        <span>选择支付方式：</span>
                                                        <input type="radio" checked name="payway" value="zfb">
                                                        <label for="pay1-btn">
                                                            <img src="<?=base_url()?>resources/assets/images/alipay.png" alt=""/>
                                                        </label>
<!--                                                        <input type="radio" id="pay2-btn" name="payway" value="wx">-->
<!--                                                        <label for="pay2-btn">-->
<!--                                                            <img src="--><?//=base_url()?><!--resources/assets/images/wechatpay.png" alt=""/>-->
<!--                                                        </label>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="controls align-left next_step">
                                    <button name="button" type="submit" class="btn btn-primary mobile-full-width next" id="shipping-continue-btn">支付</button>
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
                        <img class="img-responsive" src="<?=base_url()?>resources/assets/images/box.png" alt="Checkout summary">
                    </div>
                    <div id="cosummaryright" class="coSumBox">
                        <div id="cosummarypricebreakdown">
                            <div class="row item-title">
                                <div class="col-xs-7 no-right-padding"><b><?=$order['box_name']?></b></div>
                                <div class="col-xs-5"><b><span>¥<?=$box['monthly_price']?>/月</span></b></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 no-right-padding">升级为12月订阅（共升级<?=(12 - $order['plan_number'])?>月）</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">T-shirt: <?=1 == $order['shirt_sex'] ? '男' : '女'?> - <?=$order['shirt_size']?></div>
                            </div>
                            <div class="row subcription-month">
                                <div class="col-xs-12 no-right-padding">
                                    <span>¥<?=$box['annually_price']?>/12月(包含运费)</span>
                                </div>
                            </div>
                            <hr class="checkout-hr">
                            <div class="subscription-subtotal">
                                <div class="row">
                                    <div class="col-xs-9 no-right-padding subtotal-amount"><b>小计</b></div>
                                    <div class="col-xs-3 no-left-padding subtotal-amount">
                                        <span id="subscription-subtotal">
                                            <b><span>¥<?=$box['annually_price'] - $order['order_value']?></span></b>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <hr class="checkout-hr">
                            <div class="row">
                                <div class="col-xs-9 no-right-padding total-amount"><b>总计</b></div>
                                <div class="col-xs-3 no-left-padding total-amount">
                                    <span id="subscription-today-total">
                                        <b><span>¥<?=$box['annually_price'] - $order['order_value']?></span></b>
                                    </span>
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

<script src="/resources/assets/js/home/jquery.min.js"></script>
<script src="/resources/assets/js/home/bootstrap-select.js"></script>
<script src="/resources/assets/js/home/swiper-3.4.0.jquery.min.js"></script>
<script src="/resources/assets/js/home/bootstrap.min.js"></script>
<script src="/resources/assets/js/home/main.js"></script>
<script>
    $(function () {
        $('#checkout-continue-link').click(function(){
            $('.checkout-login-box').hide();
            $('#accordion').removeClass('hide');
        })
    })
</script>
