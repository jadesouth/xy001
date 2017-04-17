<div class="main-content">
    <div data-hook="account_summary" class="account-summary">
        <div class="container"><h1 class="account-header">我的账户</h1>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a id="account-menu-subscriptions-lnk" href="/member/order">我的订阅</a></li>
                <li role="presentation"><a id="account-menu-account-info-lnk" href="/member/account">账户信息</a>
                </li>
            </ul>
            <br>
            <?php foreach($orders as $order):?>
            <div class="row">
                <div class="animated fadeIn">
                    <div id="sub-page">
                        <div id="pagination-links"></div>
                        <div class="panel-body">
                            <div class="col-lg-6 edit-container" data-editable="true" data-fieldname="Shipping Address"
                                 data-month="April" data-nextmonth="May">
                                <div class="hpanel">
                                    <div class="panel-heading hbuilt status-canceled">
                                        <div class="subscription-header-2549757">
                                            <div class="panel-tools"><a class="showhide"
                                                                        id="toggle-subscription-name-lnk"><i
                                                        class="fa fa-chevron-up"></i></a></div>
                                            <i class="fa fa-exclamation-triangle"></i><?=$order['box_name']?> <?=$order['plan_number']?>个月
                                            <!--盒子名称 订阅计划（1个月，3个月，6个月，12个月）-->
                                        </div>
                                        <div class="status-indicator status-canceled-tab">
                                            <div class="v-center"><?=$order['next_plan_status']?></div>
                                            <!--此处是状态：当月发货了：状态为“当月已发”；订阅已发完：状态为“订单完成”-->
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="m-b-md clearfix">
                                            <div class="row"><strong>
                                                    <div class="col-xs-4"><p>下一个发货日期</p></div>
                                                    <div class="col-xs-4"><p><?=$order['next_plan_date']?></p></div>
                                                </strong>
                                                <div class="col-xs-4 order-history">
                                                    <a id="order-tracking-lnk-2549757" href="<?=base_url('member/orderdetail?order=') . $order['id']?>">订单详情
                                                    </a></div>
                                            </div>
                                            <looter_info id="looter-info2549757" class="no-margin-bottom">
                                                <div class="row">
                                                    <div class="field-label col-xs-4"><strong>衬衫号码</strong></div>
                                                    <div class="field-value col-xs-8"><?=$sex[$order['shirt_sex']]?> - <?=$order['shirt_size']?></div>
                                                </div>
                                            </looter_info>
                                            <div class="row">
                                                <div>
                                                    <div class="col-xs-4"><strong>计划类型</strong></div>
                                                    <div class="col-xs-8"><?=$order['plan_number']?>个月订阅计划</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4"><strong>送货地址</strong></div>
                                                <div class="col-xs-8">
                                                    <address id="ship_address_compact2549757" class="no-margin-bottom">
                                                        <strong><?=$order['post_name']?></strong><br><?=$order['post_addr']?><br><?=$order['post_phone']?><br>
                                                    </address>
                                                </div>
                                            </div>
                                            <?php if('订单完成' != $order['next_plan_status']):?>
                                            <div class="row">
                                                <div class="col-sm-4"></div>
                                                <div class="col-xs-12 col-sm-8 pull-text-right">
<!--                                                    <a id="" class="btn btn-primary btn-sm" href="">本月暂订</a>-->
                                                    <a id="" class="btn btn-primary btn-sm" href="">激活</a>
                                                </div>
                                            </div>
                                            <?php endif;?>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 align-center" id="upgrade-promotion">
                                <section id="upgrade-promotion-content">
                                    <div><i class="glyphicon glyphicon-heart glyphicon-2x"></i>

                                        <h1>你的礼物!</h1>

                                        <h2>1年计划</h2>

                                        <p>如果你升级到1年订阅现在你收到 <span
                                                class="hidden-lg hidden-md hidden-sm"></span>免费AmazingFunT恤
                                        </p>

                                        <p>你想升级计划吗？</p>
                                        <!--<select name="upgradeable-subscriptions" id="upgradeable-subscriptions"-->
                                        <!--class="select select2 select2-hidden-accessible valid" tabindex="-1"-->
                                        <!--aria-hidden="true">-->
                                        <!--<option value="">SELECT A SUBSCRIPTION</option>-->
                                        <!--<option value="2549757">Loot Crate Subscription 1</option>-->
                                        <!--</select>-->

                                        <p><a href="#" class="btn btn-primary" id="upgrade-link">升级</a>
                                        </p></div>
                                </section>
                            </div>
                        </div>
                        <div id="recurly_fields" class="hide">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group string required payment_method_credit_card_number"><label
                                            class="string required control-label"> <abbr title="required">*</abbr>
                                            Credit Card Number </label>

                                        <div class="controls">
                                            <div data-recurly="number" class="recurly string required number"
                                                 id="payment_method_cc"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group string required payment_method_credit_card_cvv"><label
                                            class="string required control-label"> <abbr title="required">*</abbr> CVV
                                        </label>

                                        <div class="controls">
                                            <div data-recurly="cvv" class="recurly" id="payment_method_cvv"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr">
                                    <div class="form-group date required checkout_credit_card_expiration_date"><label
                                            class="date required control-label"> <abbr title="required">*</abbr> Card
                                            Expiration Month </label>

                                        <div class="controls">
                                            <div data-recurly="month" class="recurly" id="payment_method_month"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group date required checkout_credit_card_expiration_date"><label
                                            class="date required control-label"> <abbr title="required">*</abbr> Card
                                            Expiration Year </label>

                                        <div class="controls">
                                            <div data-recurly="year" class="recurly" id="payment_method_year"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <div class="modal fade" id="shipped-alert-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="shipped-alert-modal-close-btn" class="close" data-dismiss="modal"
                                aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h2 class="modal-title">Your <span id="month"></span> crate has already shipped.</h2></div>
                    <div class="modal-body"><h4>Updates to your <span id="field"></span> will take effect for <span
                                id="nextmonth"></span>'s crate.</h4></div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true" id="close-alert">OK
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="survey_invite">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body"><h2>Success!</h2>

                        <p>Your subscription is cancelled, but we still love you!</p>

                        <p class="spacer">If you have a moment please take a quick survey to help us do better in the
                            future.</p> <a class="btn btn-primary" id="take-the-survey-lnk"
                                           href="https://www.lootcrate.com/surveys/cancellation">Take The Survey</a>

                        <div class="close-survey-link"><a id="no-thanks-lnk"
                                                          href="https://www.lootcrate.com/user_accounts/subscriptions">No
                                thanks</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="crunchyrollModal" tabindex="-1" role="crunchyrolldialog"
             aria-labelledby="crunchyrollModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content"><a href="#" data-dismiss="modal" aria-label="Close" class="close"><i
                            class="fa fa-times-circle-o fa-3" aria-hidden="true"></i></a>

                    <div class="modal-header">
                        <div class="cr-notice">Please log In to verify your Crunchyroll Premium account.</div>
                    </div>
                    <div class="modal-body" data-hook="login">
                        <iframe name="crunchy_login_iframe" width="100%" height="620px"></iframe>
                    </div>
                    <div class="modal-footer"><p>Not a Crunchyroll Member yet? Sign up!</p></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/resources/assets/js/home/jquery.min.js"></script>
<script src="/resources/assets/js/home/swiper-3.4.0.jquery.min.js"></script>
<script src="/resources/assets/js/home/bootstrap.min.js"></script>
<script src="/resources/assets/js/home/main.js"></script>