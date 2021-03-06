<div id="main-warning" class="alert alert-danger alert-dismissible col-sm-11" style="display:none" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p class="lead label label-danger">Warning!</p><br/><br/>
    <div></div>
</div>
<form id="main-form" class="form-horizontal">
    <input value="<?=$data['id']?>" name="id" type="hidden"/>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">菜单名称</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="name" value="<?=$data['name']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="url" class="col-sm-2 control-label">链接地址</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="url" id="url" value="<?=$data['url']?>">
        </div>
    </div><div class="form-group">
        <label for="list_order" class="col-sm-2 control-label">排序</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="list_order" id="list_order" value="<?=$data['list_order']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">状态</label>
        <div class="col-sm-9 radio">
            <label class="radio-inline">
                <input type="radio" name="status" value="0" <?=0 == $data['status'] ? 'checked' : ''?>> 显示
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" value="1" <?=1 == $data['status'] ? 'checked' : ''?>> 隐藏
            </label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <button id="main-submit" type="button" class="btn btn-primary btn-lg btn-block">修改菜单</button>
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
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    $('#main-submit').click(function(){
        $.ajax({
            type: "POST",
            url: "<?=base_url('admin/menu/edit')?>",
            data: $("#main-form").serialize(),
            dataType: "json",
            success: function(data){
                if(0 == data.status) {
                    if("" !== data.msg) {
                        $("#success-msg").html(data.msg);
                    }
                    $('#main-modal').modal({backdrop: 'static', keyboard: false});
                } else {
                    $("#main-warning").slideDown(200);
                    $("#main-warning > div").html(data.msg);
                }
            }
        });
    });
</script>