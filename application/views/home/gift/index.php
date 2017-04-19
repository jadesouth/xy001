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

                <p class="desc">给你的朋友或亲人的礼物，看着他们拆箱的乐趣！非重复性、一次性箱计划。没有承诺。没有订阅。给朋友的完美礼物。
                    收到礼物了吗？
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
        <form id="checkouts-steps" data-token="">
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
                                    <div id="product-core-crate" class="crate-product-node col-xs-12 col-sm-6 col-md-3">
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

                        <div class="edit-box"></div>
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
                                        <li class="btn-reset btn-gender " id="sizes-btn-mens">男士</li>
                                        <li class="btn-reset btn-gender " id="sizes-btn-womens">女士</li>
                                    </ul>
                                </div>
                                <div class="variant-options col-sm-12 col-md-7">
                                    <!--<div>-->
                                    <ul class="show-variants">
                                        <li class="mens"><span> S</span></li>
                                        <li class="mens"><span> M</span></li>
                                        <li class="mens"><span> L</span></li>
                                        <li class="mens"><span> XL</span></li>
                                        <li class="mens"><span> XXL</span></li>
                                        <li class="mens"><span> XXXL</span></li>
                                        <li class="mens"><span> 4XL</span></li>
                                        <li class="mens"><span> 5XL</span></li>
                                        <li class="womens"><span> S</span></li>
                                        <li class="womens"><span> M</span></li>
                                        <li class="womens"><span> L</span></li>
                                        <li class="womens"><span> XL</span></li>
                                        <li class="womens"><span> XXL</span></li>
                                        <li class="womens"><span> XXXL</span></li>
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
                <div class="panel">
                    <div class="panel-heading" role="tab" id="headingThree"><p class="step-number">3</p><h4
                                class="panel-title"><a id="add-recipient-link" data-toggle="collapse"
                                                       data-parent="#accordion" href="#collapseThree"
                                                       aria-expanded="false"
                                                       aria-controls="collapseThree" class="collapsed">添加收件人</a>
                        </h4>

                        <div class="edit-box"></div>
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
                                                       for="checkout_shipping_address_first_name" style="opacity: 0;">
                                                    <!-- react-text: 96 -->姓名<!-- /react-text --><abbr
                                                            title="required">*</abbr></label>

                                                <div class="controls"><input type="text" class="string fix required"
                                                                             placeholder="姓名*"
                                                                             name="checkout[shipping_address_first_name]"
                                                                             id="checkout_shipping_address_first_name"
                                                                             style="width: 100%;"></div>
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
                                                                             name="checkout[shipping_address_line_1]"
                                                                             id="checkout_shipping_address_line_1"
                                                                             style="width: 100%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 full-width">
                                            <div class="form-group select required checkout_shipping_address_country">
                                                <label class="select required control-label"
                                                       for="checkout_shipping_address_country" style="opacity: 0;">
                                                    <!-- react-text: 135 -->Country<!-- /react-text --><abbr
                                                            title="required">*</abbr></label>

                                                <div class="controls">
                                                    <select class="select required" data-recurly="city"
                                                            placeholder="城市*"
                                                            name="billing-address-country"
                                                            id="checkout_shipping_address_country"
                                                            style="width: 100%;">
                                                        <option value="BJ">北京</option>
                                                        <option value="SH">上海</option>
                                                        <option value="TJ">天津</option>
                                                        <option value="HB">河北</option>

                                                    </select></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 full-width">
                                            <div class="form-group string required checkout_shipping_address_zip"><label
                                                        class="string required control-label"
                                                        for="checkout_shipping_address_zip" style="opacity: 0;">
                                                    <!-- react-text: 128 -->邮政编码<!-- /react-text --><abbr
                                                            title="required">*</abbr></label>

                                                <div class="controls"><input type="text"
                                                                             class="string valid required populated"
                                                                             placeholder="邮政编码*"
                                                                             name="checkout[shipping_address_zip]"
                                                                             id="checkout_shipping_address_zip"
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
                                                                             name="checkout[shipping_address_line_2]"
                                                                             id="checkout_shipping_address_line_2"
                                                                             style="width: 100%;" required></div>
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
                                                       style="opacity: 0;"><abbr title="required">*</abbr>
                                                    <!-- react-text: 160 -->
                                                    收件人的电子邮件<!-- /react-text --></label>

                                                <div class="controls">
                                                    <input type="email" class="string fix required"
                                                           placeholder="收件人的电子邮件*" name="checkout[gift_email]"
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
                                                           name="checkout[checkout_email_confirm]"
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

                                            <!--<div class="form-group select required checkout_when_send_email">-->
                                            <!--<div class="controls">-->
                                            <!--<select class="select2 required" name="checkout[gift_notify_date]" id="checkout_when_send_email">-->
                                            <!--<option value="Fri Dec 23 2016 12:29:36 GMT+0800 (CST)">今天</option>-->
                                            <!--<option value="Fri Jan 20 2017 12:59:59 GMT+0800 (CST)">预计送货日期1月20日</option>-->
                                            <!--</select></div>-->
                                            <!--</div>-->
                                            <h5 class="top-label">我们应该说来自谁?</h5>

                                            <div class="form-group select required checkout_sender_name">
                                                <div class="controls">
                                                    <input type="text" class="string required" placeholder="发件人姓名*"
                                                           name="checkout[sender_name]" id="checkout_sender_name"
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
                    <div class="panel-heading" role="tab" id="headingFour"><p class="step-number">4</p><h4
                                class="panel-title">支付信息</h4>

                        <div class="edit-box"><a id="add-billing-link" data-toggle="collapse" data-parent="#accordion"
                                                 href="#collapseFour" aria-expanded="true" aria-controls="collapseFour"
                                                 class="hide">Step 4</a><!-- react-text: 184 --><!-- /react-text -->
                        </div>
                    </div>
                    <div class="quick-summary"></div>
                    <div id="collapseFour" class="panel-collapse row collapse in" role="tabpanel"
                         aria-labelledby="headingFour" aria-expanded="true" style="position: relative;">
                        <div id="section-billing-method" class="  col-sm-8">
                            <div>
                                <div>
                                    <div class="row create-login">
                                        <div class="col-xs-4"><h4>登录</h4></div>
                                        <div class="col-xs-8 right-selection"><!-- react-text: 195 -->没有账号 ?
                                            <!-- /react-text --><a class="login-register-link">创建帐号</a></div>
                                    </div>
                                </div>
                                <div id="create-login-container" class="row ">
                                    <div class="col-sm-6">
                                        <div class="form-group string required checkout_user_email"><label
                                                    class="string required control-label" for="checkout_user_email"
                                                    style="opacity: 0;"><!-- react-text: 201 -->Email 地址
                                                <!-- /react-text --><abbr title="required">*</abbr></label>

                                            <div class="controls"><input type="text"
                                                                         class="string valid required populated"
                                                                         placeholder="Email Address*"
                                                                         name="checkout[user_email]"
                                                                         id="checkout_user_email" style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group string required checkout_user_password"><label
                                                    class="string required control-label" for="checkout_user_password"
                                                    style="opacity: 0;"><!-- react-text: 208 -->密码
                                                <!-- /react-text --><abbr
                                                        title="required">*</abbr></label>

                                            <div class="controls"><input type="password"
                                                                         class="string valid required populated"
                                                                         placeholder="Password*"
                                                                         name="checkout[user_password]"
                                                                         id="checkout_user_password"
                                                                         style="width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-sm-4">
                            <img src="/resources/assets/images/tshirt-gift.png" alt="" style="width:60%;"/>
                        </div>
                        <div class="row">

                            <div class="col-sm-8 is_stuck" id="sticky">
                                <h4>订单支付</h4>
                                <div class="order-summary-container">
                                    <!--<div class="order-summary-heading">总结</div>-->
                                    <div class="order-summary-bg">
                                        <div class="form-group ">
                                            <div class="summary-receipt" id="order-summary">
                                                <div class="row no-left-right-margin"><p
                                                            class="order-summary-crate-display">AmazingFun</p>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                        <tr>
                                                            <td id="gift_plan_text">1个月礼物计划</td>
                                                            <td class="align-right" id="gift_plan_price">$199</td>
                                                        </tr>
                                                        <!-- react-empty: 572 --></tbody>
                                                    </table>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-xs-12 no-right-padding coupon-text">优惠码
                                                        </div>
                                                    </div>
                                                    <div class="row coupon-row">
                                                        <div class="col-xs-7 no-right-padding">
                                                            <input type="text" class="form-control input-lg" value=""
                                                                   name="checkout[coupon_code]"
                                                                   id="checkout_coupon_code"
                                                                   placeholder="">
                                                        </div>
                                                        <div class="col-xs-5">
                                                            <button id="validate-coupon" type="submit"
                                                                    class="btn-default btn btn-primary btn-block"
                                                                    data-plan="" data-tree="">使用
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="coupon-amount red hide">无效优惠券</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 no-right-padding coupon-text">支付方式
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-xs-12">
                                                        <input type="radio" name="pay" id="alipay"/><label for="alipay">支付宝</label>
                                                        <input type="radio" name="pay" id="wepay"/><label for="wepay">微信支付</label>
                                                    </div>
                                                    此处支付文字我会换成图片，但应该是选择一个单旋钮然后
                                                </div>
                                                <div class="row no-left-right-margin total-text">
                                                    <div class="col-xs-12 text-right no-right-padding">
                                                        <!-- react-text: 584 -->总计: <!-- /react-text -->
                                                        <!-- react-text: 585 --><div id="total">¥199</div><!-- /react-text -->
                                                    </div>
                                                </div>
                                                <hr class="checkout-hr">
                                                <div class="row">
                                                    <div class="col-xs-2 text-center">
                                                        <input type="checkbox" id="legal-checkbox" value="false"
                                                               placeholder="" class="populated"></div>
                                                    <div class="col-xs-10 legal-text"><!-- react-text: 591 -->
                                                        我已经阅读并同意AmazingFun协议 <!-- /react-text --><a
                                                                target="_blank"
                                                                href="">服务条款</a><!-- react-text: 593 -->.
                                                        <!-- /react-text -->
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 no-right-padding total-amount">
                                                        <button id="gift-submit" type="submit"
                                                                class="btn-primary btn-block" data-plan="" data-tree=""
                                                                disabled="">完成订单
                                                        </button>
                                                    </div>
                                                </div>
                                                <hr class="hide checkout-hr">
                                                <img src=""
                                                     id="or-icon" class="hide img-responsive center-block">

                                                <div class="hide row paypal-row">
                                                    <div class="col-xs-12 no-right-padding">
                                                        <button id="paypal-submit" type="submit"
                                                                class="btn-primary btn-block"><img
                                                                    src=""
                                                                    class="img-responsive center-block"
                                                                    alt="Buy now with PayPal"></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="limited-box"></div>
<div id="footer-email-capture"><h4>想要获取AmazingFun吗？</h4>
    <form method="post" role="form" action="" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
          class="validate form-search newsletter" target="_blank">
        <input type="email" required="" name="email" placeholder="Email" id="footer-mce-email">
        <input type="hidden" value="footer" name="collection_source" class="" id="collection_source">
        <input type="hidden" value="website footer" name="col-source" class="" id="mce-col-source">
        <button type="submit" class="btn btn-primary" id="footer-mc-embedded-subscribe">加入</button>
    </form>
</div>
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
                    break;
                case 'quarterly':
                    gift_plan = '3个月礼物计划';
                    gift_price = '¥ '+ $('#quarterly_price').attr('data-price');
                    break;
                case 'semiannually':
                    gift_plan = '6个月礼物计划';
                    gift_price = '¥ '+ $('#semiannually_price').attr('data-price');
                    break;
                case 'annually':
                    gift_plan = '12个月礼物计划';
                    gift_price = '¥ '+ $('#annually_price').attr('data-price');
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
            $('.variant-options').show();
            $('.variant-options').children('ul').removeClass('show-womens').addClass('show-mens');
            $('.show-variants .womens').hide();
            $('.show-variants .mens').show();
        });
        $('#sizes-btn-womens').click(function () {
            $('.variant-options').show();
            $('.variant-options').children('ul').removeClass('show-mens').addClass('show-womens');
            $('.show-variants .mens').hide();
            $('.show-variants .womens').show();
        });

        $('.crate-product-node').on('click', function () {
            $(this).parents('.panel').children('.quick-summary').html($(this).children('.crate-title').text());
            var box_id = $(this).children('.crate-title').data('id');
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
                        var quarterly_save = response.data.monthly_price*12-response.data.quarterly_price;
                        var semiannually_save = response.data.monthly_price*12-response.data.semiannually_price;
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

            $('#collapseTwo').collapse('toggle');
            $('#collapseThree').collapse('toggle');
        });
        $('.btn-next').on('click', function () {

            $('#collapseThree').collapse('toggle');
            $('#collapseFour').collapse('toggle');
        });
        $('#collapseOne').collapse('hide');
        $('#collapseFour').collapse('show')
    });
    //    $(function() {
    //        $('#my-sticky').sticky({
    //            top: 150
    //        })
    //    })

</script>