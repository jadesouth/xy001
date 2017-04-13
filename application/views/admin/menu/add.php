<div id="main-warning" class="alert alert-danger alert-dismissible col-sm-11" style="display:none" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p class="lead label label-danger">Warning!</p><br/><br/>
    <div></div>
</div>
<br /><br /><br />
<form id="main-form" class="form-horizontal">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">菜单名称</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="name" id="name" placeholder="菜单的名称，例如 AmazingFunDX">
        </div>
    </div>
    <div class="form-group">
        <label for="url" class="col-sm-2 control-label">链接地址</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="url" id="url" placeholder="链接的地址，例如 http://www.mz.com/past">
        </div>
    </div>
    <div class="form-group">
        <label for="list_order" class="col-sm-2 control-label">排序</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="list_order" id="list_order" placeholder="菜单排序,越大越靠前">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <button id="main-submit" type="button" class="btn btn-primary btn-lg btn-block">添加菜单</button>
        </div>
    </div>
</form>
<!-- Modal -->
<div class="modal fade" id="main-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">成功</h4>
            </div>
            <div id="success-msg" class="modal-body text-success">操作成功</div>
            <div class="modal-footer">
                <a href="<?=base_url()?>admin/menu/index" type="button" class="btn btn-default">返回列表</a>
                <a href="<?=base_url()?>admin/menu/add" type="button" class="btn btn-primary">继续添加</a>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    $('#main-submit').click(function(){
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>admin/menu/add",
            data: $("#main-form").serialize(),
            dataType: "json",
            success: function(response){
                if(0 == response.status) {
                    if("" !== response.msg) {
                        $("#success-msg").html(response.msg);
                    }
                    $('#main-modal').modal({backdrop: 'static', keyboard: false});
                } else {
                    $("#main-warning").slideDown(200);
                    $("#main-warning > div").html(response.msg);
                }
            }
        });
    });
</script>
