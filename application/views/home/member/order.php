<div class="main-content">
    <div data-hook="account_summary" class="account-summary">
        <div class="container"><h1 class="account-header">我的账户</h1>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a id="account-menu-subscriptions-lnk" href="<?=base_url('/member/order')?>">我的订阅</a></li>
                <li role="presentation"><a id="account-menu-account-info-lnk" href="<?=base_url('/member/account')?>">我的信息</a></li>
                <li role="presentation"><a id="account-menu-coupon-info-lnk" href="<?=base_url('/member/coupon')?>">我的账户</a></li>
            </ul>
            <br>
            <?php $show = 1; foreach($orders as $order):?>
            <div class="row">
                <div class="animated fadeIn">
                    <div id="sub-page">
                        <div class="panel-body">
                            <div class="col-lg-6 edit-container" data-editable="true" data-fieldname="Shipping Address"
                                 data-month="April" data-nextmonth="May">
                                <div class="hpanel">
                                    <div class="panel-heading hbuilt status-canceled">
                                        <div class="subscription-header-2549757">
                                            <div class="panel-tools">
                                                <a class="showhide" id="toggle-subscription-name-lnk">
                                                    <i class="fa fa-chevron-up"></i></a></div>
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
                                                    <a id="order-tracking-lnk-2549757" href="<?=base_url('member/orderdetail?order=') . $order['id']?>">订单详情</a>
                                                </div>
                                            </div>
                                          <div class="row">
                                            <div>
                                              <div class="col-xs-4"><strong>订单编号</strong></div>
                                              <div class="col-xs-8"><?=$order['order_number']?></div>
                                            </div>
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
                                                <div class="col-xs-12 col-sm-8 pull-text-right next-month">
                                                    <a class="btn btn-primary btn-sm active-month" data-order="<?=$order['id']?>">激活</a>
                                                </div>
                                            </div>
                                            <?php endif;?>
                                            <div class="row">
                                                <div class="col-xs-12"><div></div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if(1 == $show):?>
                            <div class="col-lg-6 align-center" id="upgrade-promotion">
                                    <section id="upgrade-promotion-content">
                                        <div>
                                            <i class="glyphicon glyphicon-heart glyphicon-2x"></i>
                                            <h1>你的礼物!</h1><h2>1年计划</h2>
                                            <p>如果你升级到1年订阅现在你收到 <span class="hidden-lg hidden-md hidden-sm"></span>免费AmazingFunT恤</p>
                                            <p>你想升级计划吗？</p>
                                            <select id="upgrade-order" class="selectpicker">
                                                <option value="0">选择一个你的订阅</option>
                                                <?php foreach($upgrade_orders as $order_v):?>
                                                <option value="<?=$order_v['id']?>"><?=$order_v['box_name']?></option>
                                                <?php endforeach;?>
                                            </select>
                                            <p><a href="javascript:;" class="btn btn-primary" id="upgrade-link">升级</a></p>
                                        </div>
                                    </section>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $show++; endforeach;?>
        </div>
    </div>
</div>
<script src="/resources/assets/js/home/jquery.min.js"></script>
<script src="/resources/assets/js/home/swiper-3.4.0.jquery.min.js"></script>
<script src="/resources/assets/js/home/bootstrap.min.js"></script>
<script src="/resources/assets/js/home/bootstrap-select.js"></script>
<script src="/resources/assets/js/home/main.js"></script>
<script>
    $(function() {
        $(".next-month").delegate(".active-month", "click", function(){
            var that = $(this);
            var order = that.attr('data-order');
            $.ajax({
                type: "POST",
                url: "<?=base_url("member/openNextPlan")?>",
                data: {"order": order},
                dataType: "json",
                success: function(response){
                    if(0 == response.status) {
                        that.text('下月暂订').removeClass('active-month').addClass('suspend');
                    }
                }
            });
        });
        $(".next-month").delegate(".suspend", "click", function(){
            var that = $(this);
            var order = that.attr('data-order');
            $.ajax({
                type: "POST",
                url: "<?=base_url("member/cancelNextPlan")?>",
                data: {"order": order},
                dataType: "json",
                success: function(response){
                    if(0 == response.status) {
                        that.text('激活').removeClass('suspend').addClass('active-month');
                    }
                }
            });
        });

        $("#upgrade-order").change(function() {
            var value = $(this).val();
            if (undefined == value || 0 == value || null == value) {
                return false;
            }

            $('#upgrade-link').attr('href', '/plan/upgrade?order=' + value);
        })
    });
</script>