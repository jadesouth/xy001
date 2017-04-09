<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead><tr>
            <?php foreach($table_header as $header):echo "<th>{$header}</th>";endforeach;?>
        </tr></thead>
        <tbody>
        <?php
        if(! empty($data)){
            $status = ['<span class="label label-success">正常登录</span>', '<span class="label label-danger">禁止登录</span>'];
            foreach($data as $tr) {
                echo '<tr>';
                foreach ($tr as $column_name => $value) { $td = 'status' == $column_name ? $status[$value] : $value; echo "<td>{$td}</td>";}
                if('status' == $column_name && 0 == $value){ // 0.有权限 1.无权限
                    echo '<td><a class="btn btn-danger btn-xs user-disable" data-user_id="'. $tr['id'] . '">禁止登录</a>&nbsp;&nbsp;<a class="btn btn-default btn-xs user-info" data-user_id="'. $tr['id'] . '">查看详情</a></td></tr>';
                }else{
                    echo '<td><a class="btn btn-success btn-xs user-enable" data-user_id="'. $tr['id'] . '">开启登录</a>&nbsp;&nbsp;<a class="btn btn-default btn-xs user-info" data-user_id="'. $tr['id'] . '">查看详情</a></td></tr>';
                }
            }
        } else {
            echo '<tr><td style="text-align:center;font-size:16px;padding:30px 0;" colspan="' . (count($table_header) + 1) .'">暂无用户</td></tr>';
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
                <h4 class="modal-title" id="myModalLabel">用户详情</h4>
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
        // 禁止账号登录
        $(".user-disable").click(function() {
            var user_id = $(this).data("user_id");
            $.ajax({
                type: "POST",
                url: "<?=base_url("admin/user/ajaxDisable")?>",
                data: {"user_id": user_id},
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
        // 开启账号登录
        $(".user-enable").click(function() {
            var user_id = $(this).data("user_id");
            $.ajax({
                type: "POST",
                url: "<?=base_url("admin/user/ajaxEnable")?>",
                data: {"user_id": user_id},
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

        // 查看账号信息
        $(".user-info").click(function() {
            var user_id = $(this).data("user_id");
            $.ajax({
                type: "POST",
                url: "<?=base_url("admin/user/detail")?>",
                data: {"user_id":user_id},
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
                        if (0 == response.data.status) {
                            response.data.status = '正常登录';
                        } else {
                            response.data.status = '禁止登录';
                        }
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