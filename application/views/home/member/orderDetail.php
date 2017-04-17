<div class="main-content">
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <a class="btn btn-primary" href="<?=base_url('member/order')?>">&lt;&lt; 返回我的账户</a>
                    <div class="order-history-container panel panel-default">
                        <div class="hpanel">
                            <div class="panel-heading status-canceled">
                                <div class="panel-tools"><a class="showhide" id="toggle-subscription-name-lnk"><i
                                            class="fa fa-chevron-up"></i></a></div>
                                <i class="fa fa-exclamation-triangle"></i><?=$order['box_name']?> 订阅<?=$order['plan_number']?>期
                                <div class="status-indicator status-canceled-tab">
                                    <div class="v-center"> <?=$order_status_msg?></div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="invoice">
                                <table class="table table-striped">
                                    <caption>订单信息</caption>
                                    <thead>
                                    <tr><th>订单号</th><th>日期</th><th>说明</th><th>优惠</th></tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td scope="row"><?=$order['order_number']?></td>
                                        <td><?=$order['created_at']?></td>
                                        <td><?=$order['box_name']?> <?=$order['plan_number']?></td>
                                        <td>5**元</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="replacement-shipments">
                                <table class="table table-striped">
                                    <caption>收货人信息</caption>
                                    <thead>
                                    <tr><th>收货人</th><th>地址</th><th>手机号</th></tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?=$order['post_name']?></td>
                                        <td title="<?=$order['post_addr']?>"><?=$order['post_addr']?></td>
                                        <td><?=$order['post_phone']?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="shipments">
                                <table class="table table-striped">
                                    <caption>送货详情</caption>
                                    <thead>
                                    <tr><th>发货时间</th><th>发货批次</th><th>状态</th></tr>
                                    </thead>
                                    <tbody>
                                    <?php if (! empty($order_plans)): $i = 1; foreach ($order_plans as $order_plan):?>
                                    <tr>
                                        <td><?=$order_plan['plan_date']?></td>
                                        <td><?=$i?></td>
                                        <td<?='未完成' == $order_plan['status_msg'] ? ' class="red"' : ''?>><?=$order_plan['status_msg']?></td>
                                    </tr>
                                    <?php $i++; endforeach;endif;?>
                                    </tbody>
                                </table>
                            </div>
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