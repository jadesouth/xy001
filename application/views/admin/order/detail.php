<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">订单基本信息</h3>
    </div>
    <div class="panel-body">
        <div class="col-sm-12">
            <div class="col-sm-6" style="padding-left: 0;">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th scope="row">订单编号</th>
                        <td><?=$order['order_number']?></td>
                    </tr>
                    <tr>
                        <th scope="row">下单用户</th>
                        <td><?=$user['login_email']?></td>
                    </tr>
                    <tr>
                        <th scope="row">盒子名称</th>
                        <td><?=$box['name']?></td>
                    </tr>
                    <tr>
                        <th scope="row">计划期数</th>
                        <td><?=$order['plan_number']?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6" style="padding-right: 0;">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th scope="row">邮寄姓名</th>
                        <td><?=$order['post_name']?></td>
                    </tr>
                    <tr>
                        <th scope="row">邮寄电话</th>
                        <td><?=$order['post_phone']?></td>
                    </tr>
                    <tr>
                        <th scope="row">邮寄地址</th>
                        <td><?=$order['post_addr']?></td>
                    </tr>
                    <tr>
                        <th scope="row">下单时间</th>
                        <td><?=$order['created_at']?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">计划详情</h3>
    </div>
    <div class="panel-body">
        <div class="col-sm-12">
            <table class="table">
                <thead>
                <tr><th>订单编号</th><th>计划年份</th><th>计划月份</th><th>邮寄日期</th><th>计划状态</th><th>标记状态</th></tr>
                </thead>
                <tbody>
                <?php if(! empty($order_plans)):foreach($order_plans as $order_plan):?>
                <tr>
                    <th scope="row"><?=$order['order_number']?></th>
                    <td><?=$order_plan['plan_year']?></td>
                    <td><?=$order_plan['plan_month']?></td>
                    <td><?=$order_plan['plan_date']?></td>
                    <td><?=0 == $order_plan['status'] ? '<span class="label label-success">正常邮寄</span>' : '<span class="label label-danger">暂停邮寄</span>'?></td>
                    <td><?=1 == $order_plan['sign'] ? '<span class="label label-success">已标记</span>' : '<span class="label label-info">未标记</span>'?></td>
                </tr>
                <?php endforeach; else:?>
                <tr><td style="text-align:center;font-size:16px;padding-top:10px" colspan="6">暂无计划</td></tr>
                <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
</div>