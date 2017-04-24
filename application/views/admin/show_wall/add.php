<form id="main-form" class="form-horizontal">
    <div class="form-group" style="margin-top:60px;">
        <label for="show-wall-image" class="col-sm-2 control-label">展示墙图片</label>
        <div class="col-sm-9">
            <input type="file" name="show-wall-image" lay-title="请上传一张展示墙封面图片"  class="layui-upload-file show-wall-image">
            <input type="hidden" name="image" value="">
        </div>
    </div>
    <div class="form-group">
        <label for="type" class="col-sm-2 control-label">类型</label>
        <div class="col-sm-9 radio">
            <label class="radio-inline">
                <input type="radio" name="type" checked value="1"> 图片
            </label>
            <label class="radio-inline">
                <input type="radio" name="type" value="0"> 视频
            </label>
        </div>
    </div>
    <div class="form-group">
        <label for="url" class="col-sm-2 control-label">链接地址</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="url" id="url" placeholder="链接地址">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <button type="button" id="add-show-wall" class="layui-btn">添加</button>
        </div>
    </div>
</form>
<script type="application/javascript">
    $(function() {
        layui.use(['layer', 'form', 'upload'], function () {
            layer = layui.layer;
            form = layui.form();
            upload = layui.upload();
            // 上传展示墙封面图
            layui.upload({
                elem: $('.show-wall-image')
                , url: '/upload/showWallImage'
                , ext: 'jpg|png|gif|jpeg'
                , success: function (response) {
                    if (0 == response.status) {
                        layer.msg(response.msg, {
                            icon: 6,
                            time: 1000
                        });
                        // 赋值
                        $("input[name='image']").val(response.data.show_wall);
                    } else {
                        layer.open({
                            icon: 2,
                            content: response.msg
                        });
                    }
                }
            });
        });
        // 提交表单
        $("#add-show-wall").click(function() {
            var image = $("input[name='image']").val();
            console.log(image);
            if (undefined == image || null == image || '' == image) {
                layer.confirm('请先上传展示墙封面图片', {
                    icon: 2,
                    title: '错误',
                    btn: ['确认']
                });
                return false;
            }
            $.ajax({
                type: "POST",
                url:"<?=base_url('admin/show_wall/add')?>",
                data: $('#main-form').serialize(),
                dataType: "JSON",
                success: function(data) {
                    if(0 == data.status) {
                        layer.confirm('添加展示墙成功，是否继续添加？', {
                            icon: 1,
                            title: '成功',
                            btn: ['继续添加', '返回列表']
                        }, function(){
                            window.location.reload();
                        }, function(){
                            window.location.href = "<?=base_url('/admin/show_wall')?>"
                        });
                    } else {
                        layer.confirm(data.msg, {
                            icon: 2,
                            title: '错误',
                            btn: ['确认']
                        });
                    }
                }
            });
        });
    });
</script>
