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
                echo "</td><td><a class=\"btn btn-default btn-xs user-info\" data-order=\"{$tr['id']}\">查看详情</a></td>";
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
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">订单详情</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="user-form">
                    <div class="form-group">
                        <label for="login_name" class="col-sm-2 control-label">用户ID</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control" id="id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="login_email" class="col-sm-2 control-label">登录邮箱</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control" id="login_email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">名字</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control" id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="post_name" class="col-sm-2 control-label">邮寄姓名</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control" id="post_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="post_phone" class="col-sm-2 control-label">邮寄电话</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control" id="post_phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="post_addr" class="col-sm-2 control-label">邮寄地址</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control" id="post_addr">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="created_at" class="col-sm-2 control-label">注册时间</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control" id="created_at">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">登录状态</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control" id="status">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    $(function() {
        layui.use('layer', function(){
            var layer = layui.layer;
        });
        // 查看订单信息
        $(".user-info").click(function() {
            var order = $(this).data("order");
            $.ajax({
                type: "POST",
                url: "<?=base_url("admin/order/detail")?>",
                data: {"order":order},
                dataType: "json",
                success: function(response){
                    if(0 == response.status) {
                        $("#id").val(response.data.id);
                        $("#login_email").val(response.data.login_email);
                        $("#name").val(response.data.name);
                        $("#post_name").val(response.data.post_name);
                        $("#post_phone").val(response.data.post_phone);
                        $("#post_addr").val(response.data.post_addr);
                        $("#created_at").val(response.data.created_at);
                        $("#status").val(response.data.status);
                        $('#myModal').modal();
                    } else {
                        layer.alert(response.msg, {icon: 2});
                    }
                }
            });
        });
    });
</script>