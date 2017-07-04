<style>
    body {
        background: #f9f9f9;
        color: #1e1e1e;
        font-family: proxima-nova, "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 16px;
        font-weight: 400;
        /*letter-spacing: .05em;*/
        overflow-x: hidden;
    }

    @media (min-width: 768px) {
        .all-crates .section-header {
            background-image: url("/resources/assets/images/giftbanner.png");
        }

        /*.all-crates .section-listing .product-item.core-crate .img-container {*/
        /*background-image: url("//images.contentful.com/rzwi86gxgpgo/1A4CJMfj2UeS0cISwAc4gw/00ad7154acb8aaf3b7c5dc8bcbbe082d/all-crates-lootcrate.jpg");*/
        /*}*/
    }

    @media (max-width: 768px) {
        .all-crates .section-header .hero-mobile {
            /*display: block;*/
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
    <div class="section section-header">
        <div class="wrapper">
            <img src="/resources/assets/images/giftbanner.png" alt="banner" class="hero-mobile"/>

            <div class="copy">
                <h1 class="hdr-1">选择你的盒子</h1>

                <p class="desc">选择一个惊喜计划给你的爱人或朋友.看着她们拆礼物盒子的乐趣.每期礼物都是独一无二的.选礼物没想法吗？快点定个Amazingfun给她吧
                </p>
            </div>
        </div>
    </div>

    <div class="container">
        <section id="how-it-works">
            <div class="header-3"><h2 class="hdr-1">我们的盒子是最好的礼物</h2></div>
            <section class="how-it-works-section row">
                <div class="col-sm-4 how-it-works-item"><img
                            src="/resources/assets/images/gife1.png"
                            class="how-it-works-icon">

                    <p class="how-it-works-txt">选择你想要的礼物.</p></div>
                <div class="col-sm-4 how-it-works-item"><img
                            src="/resources/assets/images/gife2.png"
                            class="how-it-works-icon">

                    <p class="how-it-works-txt">选择所需月份计划.</p></div>
                <div class="col-sm-4 how-it-works-item"><img
                            src="/resources/assets/images/gife3.png"
                            class="how-it-works-icon">

                    <p class="how-it-works-txt">添加你礼物的收件人.</p></div>
            </section>
        </section>
    </div>
    <div id="gifts-blocks" class="container">
            <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel">
                    <div class="panel-heading" id="headingOne">

                        <p class="step-number">1</p>
                        <h4 class="panel-title">
                            <a id="block-one" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                               aria-expanded="true" aria-controls="collapseOne" class="">选择礼物</a>
                        </h4>

                        <div class="edit-box">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                               aria-controls="collapseOne">编辑</a>
                        </div>
                    </div>
                    <div class="quick-summary"></div>
                    <!--<div class="quick-summary">Loot Crate</div>-->
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                         aria-labelledby="headingOne"
                         aria-expanded="true">
                        <div class="crate-container row">
                            <?php if(!empty($gift_list) && is_array($gift_list)): ?>
                                <?php foreach ($gift_list as $gift_info){?>
                                    <div id="product-core-crate" class="crate-product-node col-xs-12 col-sm-6 col-md-3 box-id-<?=$gift_info['id']?>">
                                        <img src="<?=$gift_info['gift_image']?>"
                                             alt="<?=$gift_info['theme_name']?>" class="crate-img">

                                        <p class="crate-title col-xs-12" data-id="<?=$gift_info['id']?>"><?=$gift_info['theme_name']?></p>

                                        <div class="overlay"><p class="product-description"><?=$gift_info['gift_introduction']?></p>

                                            <p class="starting-at">起始于<?=$gift_info['year']?>-<?=$gift_info['month']?></p>

                                            <p class="preview-price"><span class="currency">¥</span><!-- react-text: 604 --><?=$gift_info['monthly_price']?>/月
                                                <!-- /react-text --><span class="cents"></span><br></p></div>
                                        <div class="product-description-mobile"><p class="description"><?=$gift_info['gift_introduction']?></p>
                                        </div>
                                    </div>
                                <?php }?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <div class="panel" id="subscription-builder">
                    <div class="panel-heading" id="headingTwo"><p class="step-number">2</p><h4 class="panel-title"><a
                                    id="select-gift-link" data-toggle="collapse" data-parent="#accordion"
                                    href="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo" class="collapsed">选择礼物计划</a></h4>

                         <div class="edit-box">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="collapsed">编辑</a>
                         </div>
                    </div>
                    <div class="quick-summary"><!-- react-text: 48 --> <!-- /react-text --><!-- react-text: 49 -->
                        <!-- /react-text --></div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingTwo" aria-expanded="false">
                        <div id="section-plans" class="row">
                            <div id="plan-1606" class="subscription-plan-node col-xs-6 col-sm-3  plans-4" data-plan="monthly"><h3
                                        class="title plan-name"><!-- react-text: 832 -->1期计划
                                    <!-- /react-text --><span class="title plan-duration">1个月</span></h3>

                                <p class="price plan-price" id="monthly_price" data-price=""><span class="currency currency-symbol">¥</span>
                                    <!-- react-text: 836 -->
                                    129<!-- /react-text --><span class="cents">00</span></p>

                                <p class="save plan-savings"></p></div>
                            <div id="plan-1607" class="subscription-plan-node col-xs-6 col-sm-3  plans-4" data-plan="quarterly"><h3
                                        class="title plan-name"><!-- react-text: 841 -->3期计划
                                    <!-- /react-text --><span class="title plan-duration">3个月</span></h3>

                                <p class="price plan-price" id="quarterly_price" data-price=""><span class="currency currency-symbol">¥</span>
                                    <!-- react-text: 845 -->
                                    327<!-- /react-text --><span class="cents">00</span></p>

                                <p class="save plan-savings quarterly">省 ¥15.85</p></div>
                            <div id="plan-1608" class="subscription-plan-node col-xs-6 col-sm-3  plans-4" data-plan="semiannually"><h3
                                        class="title plan-name"><!-- react-text: 850 -->6期计划
                                    <!-- /react-text --><span class="title plan-duration">6个月</span></h3>

                                <p class="price plan-price" id="semiannually_price" data-price=""><span class="currency currency-symbol">¥</span>
                                    <!-- react-text: 854 -->
                                    654<!-- /react-text --><span class="cents">00</span></p>

                                <p class="save plan-savings semiannually">省 ¥42.70</p></div>
                            <div id="plan-1643" class="subscription-plan-node col-xs-6 col-sm-3  plans-4" data-plan="annually"><h3
                                        class="title plan-name"><!-- react-text: 859 -->12期计划
                                    <!-- /react-text --><span class="title plan-duration">12个月</span></h3>

                                <p class="price plan-price" id="annually_price" data-price=""><span class="currency currency-symbol">¥</span>
                                    <!-- react-text: 863 -->
                                    1308<!-- /react-text --><span class="cents">00</span></p>

                                <p class="save plan-savings annually">省 ¥102.40</p></div>
                        </div>
                        <div class="shipping-note">运费和包装都包含在你所支付的费用中
                        </div>
                        <div id="section-variants" class="variants section-container row"><h2>选择T恤号码</h2>
                            <section class="variant_headers">
                                <div class="variant-filters col-sm-12 col-md-5">
                                    <ul class="gender-filter-list">
                                        <li class="btn-reset btn-gender " id="sizes-btn-mens" data-sex="1">男士</li>
                                        <li class="btn-reset btn-gender " id="sizes-btn-womens" data-sex="2">女士</li>
                                    </ul>
                                </div>
                                <div class="variant-options col-sm-12 col-md-7">
                                    <!--<div>-->
                                    <ul class="show-variants">
                                        <li class="mens" data-size="S"><span> S</span></li>
                                        <li class="mens" data-size="M"><span> M</span></li>
                                        <li class="mens" data-size="L"><span> L</span></li>
                                        <li class="mens" data-size="XL"><span> XL</span></li>
                                        <li class="mens" data-size="2XL"><span> XXL</span></li>
                                        <li class="mens" data-size="3XL"><span> XXXL</span></li>
                                        <li class="mens" data-size="4XL"><span> 4XL</span></li>
                                        <li class="mens" data-size="5XL"><span> 5XL</span></li>
                                        <li class="womens" data-size="S"><span> S</span></li>
                                        <li class="womens" data-size="M"><span> M</span></li>
                                        <li class="womens" data-size="L"><span> L</span></li>
                                        <li class="womens" data-size="XL"><span> XL</span></li>
                                        <li class="womens" data-size="2XL"><span> XXL</span></li>
                                        <li class="womens" data-size="3XL"><span> XXXL</span></li>
                                    </ul>
                                    <!--</div>-->
                                </div>
                                <div class="sizing-chart col-xs-12"><p class="help-block">
                                        <a class="popover-link" id="core-crate-shirt-popover" href="#"
                                           data-original-title="" title=""><span>号码参照</span></a>
                                    </p></div>
                                <div id="core-crate-shirt-popover-content" class="popover-content hide"><img
                                            class="img-responsive" alt="Sizing Chart"
                                            src="/resources/assets/images/Human_T_Size_Chart.jpg">
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <form id="checkouts-steps" action="/gift/pay" method="post">
                    <input type="hidden" name="box_id">
                    <input type="hidden" name="plan">
                    <input type="hidden" name="shirt_sex">
                    <input type="hidden" name="shirt_size">
                <div class="panel">
                    <div class="panel-heading" role="tab" id="headingThree"><p class="step-number">3</p><h4
                                class="panel-title"><a id="add-recipient-link" data-toggle="collapse"
                                                       data-parent="#accordion" href="#collapseThree" aria-expanded="false"
                                                       aria-controls="collapseThree" class="collapsed">添加收件人</a>
                        </h4>

                        <div class="edit-box">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="collapsed">编辑</a>
                        </div>
                    </div>
                    <div id="after-filled" class="quick-summary hide">

                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingThree" aria-expanded="false">
                        <div class="row">
                            <div class="col-sm-8"><h4>发货信息</h4>

                                <div class="">
                                    <div class="row">
                                        <div class="col-sm-12 full-width">
                                            <div class="form-group string required checkout_shipping_address_first_name">
                                                <label class="string required control-label"
                                                       for="checkout_shipping_address_name" style="opacity: 0;">
                                                    <!-- react-text: 96 -->姓名<!-- /react-text --><abbr
                                                            title="required">*</abbr></label>

                                                <div class="controls">
                                                    <input type="text" class="string fix required"
                                                           placeholder="姓名*"
                                                           name="post_name"
                                                           id="checkout_shipping_address_name" style="width: 100%;">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 full-width">
                                            <div class="form-group string required checkout_shipping_address_line_1">
                                                <label class="string required control-label"
                                                       for="checkout_shipping_address_line_1" style="opacity: 0;">
                                                    <!-- react-text: 111 -->电话
                                                    <!-- /react-text --><abbr title="required">*</abbr></label>

                                                <div class="controls"><input type="text" class="string fix required"
                                                                             placeholder="电话*"
                                                                             name="post_phone"
                                                                             id="checkout_shipping_address_line_1"
                                                                             style="width: 100%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 full-width">
                                            <div class="form-group string required checkout_shipping_address_line_2">
                                                <label class="string required control-label"
                                                       for="checkout_shipping_address_line_2"
                                                       style="opacity: 0;">收货地址</label>

                                                <div class="controls"><input type="text" class="string required"
                                                                             placeholder="收货地址＊"
                                                                             name="post_addr"
                                                                             id="checkout_shipping_address_line_2"
                                                                             style="width: 100%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 full-width">
                                            <div class="form-group string  checkout_shipping_answer">
                                                <label class="string required control-label"
                                                       for="checkout_shipping_answer"
                                                       style="opacity: 0;">留言</label>

                                                <div class="controls">
                                                    <input type="text" class="string required" placeholder="网络解忧杂货店键入您遇到的烦恼和问题"
                                                           name="leave_word"
                                                           id="checkout_shipping_answer"
                                                           style="width: 100%;" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="gift-email-container"><h4>礼物补充说明</h4>

                                    <div class="row ">
                                        <div class="full-width">
                                            <div class="form-group string required checkout_gift_email">
                                                <label class="string required control-label" for="checkout_gift_email"
                                                       style="opacity: 0;"><abbr title="required">*</abbr><!-- react-text: 160 -->
                                                    收件人的电子邮件<!-- /react-text --></label>

                                                <div class="controls">
                                                    <input type="email" class="string fix required"
                                                           placeholder="收件人的电子邮件*" name="gift_email"
                                                           id="checkout_gift_email"
                                                           style="width: 100%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="full-width">
                                            <div class="form-group string required checkout_gift_email_confirm"><label
                                                        class="string required control-label"
                                                        for="checkout_gift_email_confirm" style="opacity: 0;">
                                                    <abbr title="required">*</abbr><!-- react-text: 168 -->确认收件人的电子邮件
                                                    <!-- /react-text --></label>

                                                <div class="controls">
                                                    <input type="email" class="string fix required"
                                                           placeholder="确认收件人的电子邮件*"
                                                           name="gift_email_confirm"
                                                           id="checkout_gift_email_confirm" style="width: 100%;">

                                                    <p class="hide error" id="email_check_error_msg">电子邮件地址不匹配</p></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="email-confirmation-text">
                                            <h6>我们需要一个电子邮件地址，以便您收件人可以要求他们的网上帐户找回礼物。</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="full-width">
                                            <h5 class="top-label">我们会给您的朋友发送电子邮件</h5>
                                            <h5 class="top-label">我们应该说来自谁?</h5>

                                            <div class="form-group select required checkout_sender_name">
                                                <div class="controls">
                                                    <input type="text" class="string required" placeholder="发件人姓名*"
                                                           name="sender_name" id="checkout_sender_name"
                                                           style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="continue-container"><a
                                                        class="btn btn-primary btn-large btn-next">继续</a></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-heading" role="tab" id="headingFour">
                        <p class="step-number">4</p>
                        <h4 class="panel-title">支付信息</h4>

                        <div class="edit-box">
                            <a id="add-billing-link" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseFour" aria-expanded="true" aria-controls="collapseFour"
                               class="hide">Step 4
                            </a><!-- react-text: 184 --><!-- /react-text -->
                        </div>
                    </div>
                    <div class="quick-summary"></div>
                    <div id="collapseFour" class="panel-collapse row collapse in" role="tabpanel"
                         aria-labelledby="headingFour" aria-expanded="true" style="position: relative;">
                        <?php if(empty($_SESSION['home_login_user'])){?>
                        <div id="section-billing-method" class="  col-sm-8">
                            <div>
                                <div>
                                    <div class="row create-login">
                                        <div class="col-xs-4"><h4>登录</h4></div>
                                        <div class="col-xs-8 right-selection"><!-- react-text: 195 -->没有账号 ?
                                          <button class="login-register-link" data-target="#loginmodal" data-toggle="modal">创建帐号</button>
</div>
                                    </div>
                                </div>
                                <div id="create-login-container" class="row ">
                                    <div class="col-sm-6">
                                        <div class="form-group string required checkout_user_email"><label
                                                    class="string required control-label" for="checkout_user_email"
                                                    style="opacity: 0;"><!-- react-text: 201 -->Email 地址
                                                <!-- /react-text --><abbr title="required">*</abbr></label>

                                            <div class="controls">
                                                <input type="text" class="string valid required populated" placeholder="Email Address*"
                                                       name="user_email" id="checkout_user_email" style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group string required checkout_user_password"><label
                                                    class="string required control-label" for="checkout_user_password"
                                                    style="opacity: 0;"><!-- react-text: 208 -->密码<!-- /react-text --><abbr
                                                        title="required">*</abbr></label>

                                            <div class="controls"><input type="password"
                                                                         class="string valid required populated"
                                                                         placeholder="Password*"
                                                                         name="user_password"
                                                                         id="checkout_user_password"
                                                                         style="width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <div class="row">

                            <div class="col-sm-8 is_stuck" id="sticky">
                                <h4>订单支付</h4>
                                <div class="order-summary-container">
                                    <!--<div class="order-summary-heading">总结</div>-->
                                    <div class="order-summary-bg">
                                        <div class="form-group ">
                                            <div class="summary-receipt" id="order-summary">
                                                <div class="row no-left-right-margin"><p
                                                            class="order-summary-crate-display">盒子主题</p>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                        <tr>
                                                            <td id="gift_plan_text">礼物计划</td>
                                                            <td class="align-right" id="gift_plan_price">金额</td>
                                                        </tr>
                                                        <!-- react-empty: 572 --></tbody>
                                                    </table>
                                                </div>
                                                <?php if(!empty($coupons)) :?>
                                                    <div class="row">
                                                        <div class="col-md-12 short-width">
                                                            <span>选择优惠券：</span>
                                                            <?php foreach($coupons as $coupon) :?>
                                                                <div class="form-group string optional checkout_shipping_pay coupon_list radio">

                                                                    <input type="radio" class="" name="coupon" value="<?=$coupon['id']?>" id="coupon-<?=$coupon['id']?>">
                                                                    <label for="coupon-<?=$coupon['id']?>" class="coupon coupon-<?=$coupon['id']?>">
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
                                                    <div class="col-xs-12 no-right-padding coupon-text">支付方式
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-xs-12">
                                                        <input type="radio" name="pay" id="alipay" class="pay" value="alipay" checked/><label for="alipay"><img
                                                                    src="/resources/assets/images/alipay.png" alt="" style="width:40px;"/></label>
                                                        <input type="radio" name="pay" id="wepay" class="pay" value="wxpay"/><label for="wepay"><img
                                                                    src="/resources/assets/images/wechatpay.png" alt=""style="width:40px;" /></label>
                                                    </div>
                                                </div> <div class="row no-left-right-margin total-text">
                                                    <div class="col-xs-12 text-right no-right-padding">
                                                        总计:<span id="total">金额</span>
                                                    </div>
                                                </div>
                                                <hr class="checkout-hr">
                                                <div class="row">
                                                    <div class="col-xs-2 text-center">
                                                        <input type="checkbox" id="legal-checkbox" value="false" placeholder="" class="populated"></div>
                                                    <div class="col-xs-10 legal-text"><!-- react-text: 591 --> 我已经阅读并同意AmazingFun协议 <!-- /react-text -->
                                                      <a target="_blank" href="<?=base_url('home/termsofservice')?>">服务条款</a><!-- react-text: 593 -->.<!-- /react-text -->
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 no-right-padding total-amount">
                                                        <button id="gift-submit" type="submit"
                                                                class="btn-primary btn-block" disabled="disabled">完成订单
                                                        </button>
                                                    </div>
                                                </div>
        </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <img src="/resources/assets/images/tshirt-gift.png" alt="" style="width:60%;"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>

<div class="limited-box"></div>
<script src="/resources/assets/js/home/jquery.min.js"></script>
<script src="/resources/assets/js/home/swiper-3.4.0.jquery.min.js"></script>
<script src="/resources/assets/js/home/bootstrap.min.js"></script>
<script src="/resources/assets/js/home/main.js"></script>
<script src="/resources/assets/libs/layui/layui.js" type="application/javascript"></script>
<script>
    $(function () {
        // 加载layer
        layui.use('layer', function () {
            var layer = layui.layer;
        });
        $('.filter-item').click(function () {
            $(this).addClass('active');
            $(this).siblings('.filter-item').removeClass('active');
        });
        $('.overlay').hover(function () {
            $(this).css('opacity', '1');
        }, function () {
            $(this).css('opacity', '0');

        });

        $('#section-plans>div').on('click', function () {
            $(this).css('border-color', '#ff5f00');
            $(this).siblings().css('border-color', '#ccc');
            var plan = $(this).data('plan');
            var gift_plan = '';
            var gift_price = '';
            switch(plan)
            {
                case 'monthly':
                    gift_plan = '1个月礼物计划';
                    gift_price = '¥ '+ $('#monthly_price').attr('data-price');
                    $("input[name=plan]").val(1)
                    break;
                case 'quarterly':
                    gift_plan = '3个月礼物计划';
                    gift_price = '¥ '+ $('#quarterly_price').attr('data-price');
                    $("input[name=plan]").val(3)
                    break;
                case 'semiannually':
                    gift_plan = '6个月礼物计划';
                    gift_price = '¥ '+ $('#semiannually_price').attr('data-price');
                    $("input[name=plan]").val(6)
                    break;
                case 'annually':
                    gift_plan = '12个月礼物计划';
                    gift_price = '¥ '+ $('#annually_price').attr('data-price');
                    $("input[name=plan]").val(12)
                    break;
            }
            $("#gift_plan_text").html(gift_plan);
            $("#gift_plan_price").html(gift_price);
            $("#total").html(gift_price);

        });
        $('#sizes-btn-womens,#sizes-btn-mens,.mens,.womens').on('click', function () {
            $(this).css({'border-color': '#ff5f00', 'color': '#ff5f00'});
            $(this).siblings().css({'border-color': '#ccc', 'color': '#ddd'});

        });
        $('#sizes-btn-mens').click(function () {
            $("input[name=shirt_sex]").val($(this).data('sex'));
            $('.variant-options').show();
            $('.variant-options').children('ul').removeClass('show-womens').addClass('show-mens');
            $('.show-variants .womens').hide();
            $('.show-variants .mens').show();
        });
        $('#sizes-btn-womens').click(function () {
            $("input[name=shirt_sex]").val($(this).data('sex'));
            $('.variant-options').show();
            $('.variant-options').children('ul').removeClass('show-mens').addClass('show-womens');
            $('.show-variants .mens').hide();
            $('.show-variants .womens').show();
        });

        $('.crate-product-node').on('click', function () {
            $(this).parents('.panel').children('.quick-summary').html($(this).children('.crate-title').text());
            $('.order-summary-crate-display').html($(this).children('.crate-title').text());
            var box_id = $(this).children('.crate-title').data('id');
            $("input[name=box_id]").val(box_id);
            $.ajax({
                type: "POST",
                url: "<?=base_url('/product/ajaxGetBoxInfo')?>",
                data: {"id":box_id},
                dataType: "json",
                success: function(response){
                    if(0 == response.status) {
                        $('#monthly_price').html('');
                        var monthly_price = response.data.monthly_price.split('.');
                        var quarterly_price = response.data.quarterly_price.split('.');
                        var semiannually_price = response.data.semiannually_price.split('.');
                        var annually_price = response.data.annually_price.split('.');
                        var quarterly_save = response.data.monthly_price*3-response.data.quarterly_price;
                        var semiannually_save = response.data.monthly_price*6-response.data.semiannually_price;
                        var annually_save = response.data.monthly_price*12-response.data.annually_price;
                        $(".save.plan-savings.quarterly").html('省 ¥'+quarterly_save.toFixed(2));
                        $(".save.plan-savings.semiannually").html('省 ¥'+semiannually_save.toFixed(2));
                        $(".save.plan-savings.annually").html('省 ¥'+annually_save.toFixed(2));
                        $('#monthly_price').html("<span class='currency currency-symbol'>¥</span>"+monthly_price[0]+"<span class='cents'>"+monthly_price[1]+"</span>");
                        $('#monthly_price').attr('data-price',monthly_price[0]+'.'+monthly_price[1]);
                        $('#quarterly_price').html("<span class='currency currency-symbol'>¥</span>"+quarterly_price[0]+"<span class='cents'>"+quarterly_price[1]+"</span>");
                        $('#quarterly_price').attr('data-price',quarterly_price[0]+'.'+quarterly_price[1]);
                        $('#semiannually_price').html("<span class='currency currency-symbol'>¥</span>"+semiannually_price[0]+"<span class='cents'>"+semiannually_price[1]+"</span>");
                        $('#semiannually_price').attr('data-price',semiannually_price[0]+'.'+semiannually_price[1]);
                        $('#annually_price').html("<span class='currency currency-symbol'>¥</span>"+annually_price[0]+"<span class='cents'>"+annually_price[1]+"</span>");
                        $('#annually_price').attr('data-price',annually_price[0]+'.'+annually_price[1]);
                    } else {
                        layer.alert(response.msg, {icon: 2});
                        return false;
                    }
                }
            });
            $('#collapseOne').collapse('toggle');
            $('#collapseTwo').collapse('toggle');
        });
        $('.mens,.womens').on('click', function () {
            $("input[name=shirt_size]").val($(this).data('size'));
            $('#collapseTwo').collapse('toggle');
            $('#collapseThree').collapse('show');
            var str=$('.subscription-plan-node.active .plan-name').text()+$('.subscription-plan-node.active .btn-reset').text()+$('.btn-reset.active').text()+$('.show-variants li.active').text();
                        $('#headingTwo').siblings('.quick-summary').text(str);
        });

        $('#legal-checkbox').on('click',function(){
            var value = $(this).val();
            if(value == 'false'){
                $(this).val('true')
                $("#gift-submit").attr("disabled", false);
            }else{
                $(this).val('false')
                $("#gift-submit").attr("disabled", true);
            }
        });
        $('#checkout_user_email,#checkout_user_password').on('blur',function(){
            var user_email = $('#checkout_user_email').val();
            var user_password = $('#checkout_user_password').val();
            $.ajax({
                type: "POST",
                url: "/user/ajax_check_user",
                data: {"email": user_email,"password": user_password},
                dataType: "json",
                success: function(response){
                    if (1 == response.status) {
                        layer.alert(response.msg, {icon: 2});
                        return false;
                    }else if(0 == response.status) {

                    }
                }
            });
        });
        $('.coupon_list').click(function () {
            var coupon_price = $(this).find('.coupon-price').html();
            var total_price = $('#total').text() - coupon_price;
            $('#total').text('¥'+total_price);
        })
        var box_id = $('input[name=box_id]').val();
        if (box_id) {
            $('#headingOne').next().html($('.box-id-' + box_id).find('.crate-title').text());
            $('.order-summary-crate-display').html($('.box-id-' + box_id).find('.crate-title').text());
        }
        var coupon_id = $("input[name='coupon']:checked").attr('id');
        if(coupon_id != null){
            var coupon_price = $('.'+coupon_id).find('.coupon-price').html();
            var total_price = $('#price').text() - coupon_price;
            $('#total').text('¥'+total_price);
        }
        $('.btn-next').on('click', function () {

                    $('#collapseThree').collapse('toggle');
                    $('#collapseFour').collapse('toggle');
                    var str=$('#checkout_shipping_address_name').val()+" "+$('#checkout_shipping_tel').val()+" "+$('#checkout_shipping_address_line').val()+" "+$('#checkout_gift_email_confirm').val();
                    $('#headingThree').siblings('.quick-summary').text(str);
                });
        if($('#legal-checkbox').is(':checked')){
            $("#gift-submit").attr("disabled", false);
        }else{
            $("#gift-submit").attr("disabled", true);
        }
        $('#collapseOne').collapse('show');
    });

</script>