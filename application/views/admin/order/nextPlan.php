<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead><tr>
            <th>#</th><th>邮寄信息</th><th>下期时间</th><th>操作</th>
        </tr></thead>
        <tbody>
        <?php
        if(! empty($data)){
            $sign = ['<span class="label label-info">未标记</span>', '<span class="label label-success">已标记</span>'];
            foreach($data as $tr) {
                echo '<tr>';
                echo "<td>{$tr['order_number']}</td><td>{$tr['post_name']}<br />{$tr['post_phone']}<br />{$tr['post_addr']}</td><td>";
                echo ! empty($tr['plan_date']) ? $tr['plan_date'] : '暂无下期';
                echo '</td><td>';
                echo in_array($tr['sign'], [0, 1]) ? $sign[$tr['sign']] : '';
                echo '</td><td><a class="btn btn-default btn-xs" href="' . base_url('admin/order/detail?order=' . $tr['order_id']) . '">查看详情</a>';
                if (0 != $tr['order_plan_id'] && 1 != $tr['sign']) {
                    echo '&nbsp;<button class="btn btn-primary btn-xs sign-plan" data-order-plan="' . $tr['order_plan_id'] .'">标记状态</button>';
                }
                echo '</td></tr>';
            }
        } else {
            echo '<tr><td style="text-align:center;font-size:16px;padding:30px 0;" colspan="6">暂无订单</td></tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<?php if(! empty($page)){echo $page;}?>

<script type="application/javascript">
    $(function () {
        layui.use('layer', function(){
            var layer = layui.layer;
        });
        // 标记订单状态
        $(".sign-plan").click(function() {
            var order_plan = $(this).data("order-plan");
            $.ajax({
                type: "POST",
                url: "<?=base_url("admin/order/setSign")?>",
                data: {"order_plan": order_plan},
                dataType: "json",
                success: function(response){
                    if(0 == response.status) {
                        layer.alert(response.msg, {icon: 1}, function() {
                            window.location.reload();
                        });
                    } else {
                        layer.alert(response.msg, {icon: 2});
                    }
                }
            });
        });
    });
</script>