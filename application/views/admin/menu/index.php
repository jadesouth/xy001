<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead><tr>
            <?php foreach($table_header as $header):echo "<th>{$header}</th>";endforeach;?>
        </tr></thead>
        <tbody>
        <?php
        if(! empty($data)){
            $status = ['<span class="label label-success">显示</span>', '<span class="label label-danger">隐藏</span>'];
            foreach($data as $tr) {
                echo '<tr>';
                foreach ($tr as $column_name => $value) { $td = 'status' == $column_name ? $status[$value] : $value; echo "<td>{$td}</td>";}
                if('status' == $column_name && 0 == $value){ // 0.有权限 1.无权限
                    echo '<td><a class="btn btn-danger btn-xs menu-disable" data-menu_id="'. $tr['id'] . '">隐藏</a>&nbsp;&nbsp;<a class="btn btn-default btn-xs menu-info" data-menu_id="'. $tr['id'] . '">查看详情</a>&nbsp;&nbsp;<a class="btn btn-default btn-xs delete-menu" data-menu_id="'. $tr['id'] . '">删除</a></td></tr>';
                }else{
                    echo '<td><a class="btn btn-success btn-xs menu-enable" data-menu_id="'. $tr['id'] . '">显示</a>&nbsp;&nbsp;<a class="btn btn-default btn-xs menu-info" data-menu_id="'. $tr['id'] . '">查看详情</a>&nbsp;&nbsp;<a class="btn btn-default btn-xs delete-menu" data-menu_id="'. $tr['id'] . '">删除</a></td></tr>';
                }
            }
        } else {
            echo '<tr><td style="text-align:center;font-size:16px;padding:30px 0;" colspan="' . (count($table_header) + 1) .'">暂无菜单</td></tr>';
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
                <h4 class="modal-title" id="myModalLabel">菜单详情</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="menu-form">
                    <div class="form-group">
                        <label for="id" class="col-sm-2 control-label">菜单ID</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control" id="id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">菜单名称</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control" id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="list_order" class="col-sm-2 control-label">排序</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control" id="list_order">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">状态</label>
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
        // 隐藏菜单
        $(".menu-disable").click(function() {
            var menu_id = $(this).data("menu_id");
            $.ajax({
                type: "POST",
                url: "<?=base_url("admin/menu/ajaxDisable")?>",
                data: {"menu_id": menu_id},
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
        // 显示菜单
        $(".menu-enable").click(function() {
            var menu_id = $(this).data("menu_id");
            $.ajax({
                type: "POST",
                url: "<?=base_url("admin/menu/ajaxEnable")?>",
                data: {"menu_id": menu_id},
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

        // 查看菜单信息
        $(".menu-info").click(function() {
            var menu_id = $(this).data("menu_id");
            $.ajax({
                type: "POST",
                url: "<?=base_url("admin/menu/detail")?>",
                data: {"menu_id":menu_id},
                dataType: "json",
                success: function(response){
                    if(0 == response.status) {
                        console.log(response.data);
                        $("#id").val(response.data.id);
                        $("#name").val(response.data.name);
                        $("#list_order").val(response.data.list_order);
                        if (0 == response.data.status) {
                            response.data.status = '显示';
                        } else {
                            response.data.status = '隐藏';
                        }
                        $("#status").val(response.data.status);
                        $('#myModal').modal();
                    } else {
                        layer.alert(response.msg, {icon: 2});
                    }
                }
            });
        });
        // 删除菜单
        $(".delete-menu").click(function() {
            var menu_id = $(this).data("menu_id");
            $.ajax({
                type: "POST",
                url: "<?=base_url("admin/menu/ajaxDelete")?>",
                data: {"menu_id": menu_id},
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