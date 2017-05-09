<div class="main-content">
    <div data-hook="account_summary" class="account-summary">
        <div class="container"><h1 class="account-header">我的账户</h1>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation"><a id="account-menu-subscriptions-lnk" href="<?=base_url('member/order')?>">我的订阅</a></li>
                <li role="presentation"><a id="account-menu-account-info-lnk" href="<?=base_url('member/account')?>">我的信息</a></li>
                <li role="presentation" class="active"><a id="account-menu-coupon-info-lnk" href="<?=base_url('member/coupon')?>">我的账户</a></li>
            </ul>
            <br>
            <div class="row">
                <div class="animated fadeIn">
                    <div id="sub-page">
                        <div id="pagination-links"></div>
                        <div class="panel-body">
                            <div class="col-lg-6 edit-container" data-editable="true" data-fieldname="Shipping Address" data-month="April" data-nextmonth="May">
                                <div class="hpanel">
                                    <div class="panel-heading hbuilt status-canceled">
                                        <div class="subscription-header-2549757">
                                            <div class="panel-tools">
                                                <a class="showhide" id="toggle-subscription-name-lnk">
                                                    <i class="fa fa-chevron-up"></i>
                                                </a>
                                            </div>
                                            <i class="fa fa-exclamation-triangle"></i>我的优惠券
                                        </div>
                                    </div>
                                    <div class="panel-body youhui">
                                        <ul>
                                            <li><a href="javascript:void(0);">未使用</a></li>
                                            <li><a href="javascript:void(0);">已使用</a></li>
                                            <li><a href="javascript:void(0);">已过期</a></li>
                                        </ul>
                                        <div class="coupon-items ">
                                            <?php if(! empty($coupons)): foreach($coupons as $coupon):
                                                $class = '';
                                                $text = '去使用';
                                                $url = base_url('/');
                                                if(1 == $coupon['status']) {
                                                    $class = ' coupon-use';
                                                    $text = '已使用';
                                                    $url = 'javascript:void(0);';
                                                } elseif (2 == $coupon['status']) {
                                                    $class = ' overtime';
                                                    $text = '已过期';
                                                    $url = 'javascript:void(0);';
                                                }
                                                ?>
                                                <div class="coupon-item<?=$class?>">
                                                    <div class="coupon-up<?=$class?>">
                                                        <p class="coupon-left">
                                                            <span class="coupon-a">¥</span>
                                                            <span class="coupon-price"><?=(int)$coupon['value']?></span>
                                                            <span class="coupon-title">优惠券</span>
                                                        </p>
                                                        <a href="<?=$url?>" class="coupon-right"><?=$text?></a>
                                                        <p class="text-center coupon-time"><?=$coupon['use_time']?></p>
                                                    </div>
                                                </div>
                                            <?php endforeach;endif;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        </div>
                    </div>
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