<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead><tr>
            <th>#</th><th>邮寄信息</th><th>计划</th><th>下期时间</th><th>操作</th>
        </tr></thead>
        <tbody>
        <?php
        if(! empty($data)){
            $status = ['<span class="label label-success">正常登录</span>', '<span class="label label-danger">禁止登录</span>'];
            foreach($data as $tr) {
                echo '<tr>';
                echo "<td>{$tr['order_number']}</td><td>{$tr['post_name']}<br />{$tr['post_phone']}<br />{$tr['post_addr']}</td>";
                echo "<td>{$tr['completed']}/{$tr['plan_number']}</td><td>";
                echo ! empty($tr['plan_date']) ? $tr['plan_date'] : '暂无下期';
                echo '</td><td><a class="btn btn-default btn-xs" href="' . base_url('admin/order/detail?order=' . $tr['id']) . '">查看详情</a></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td style="text-align:center;font-size:16px;padding:30px 0;" colspan="5">暂无订单</td></tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<?php if(! empty($page)){echo $page;}?>