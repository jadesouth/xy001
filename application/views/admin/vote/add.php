<form id="main-form" class="form-horizontal">
  <div class="form-group" style="margin-top:60px;">
    <label for="content" class="col-sm-2 control-label">投票内容</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="content" id="content" placeholder="投票内容">
    </div>
  </div>
  <div class="form-group">
    <label for="vote-image" class="col-sm-2 control-label">投票图片</label>
    <div class="col-sm-9">
      <input type="file" name="vote-image" lay-title="请上传一张投票图片"  class="layui-upload-file vote-image">
      <input type="hidden" name="image" value="">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-9">
      <button type="button" id="add-vote" class="layui-btn">添加</button>
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
                elem: $('.vote-image')
                , url: '/upload/voteImage'
                , ext: 'jpg|png|gif|jpeg'
                , success: function (response) {
                    if (0 == response.status) {
                        layer.msg(response.msg, {
                            icon: 6,
                            time: 1000
                        });
                        // 赋值
                        $("input[name='image']").val(response.data.vote);
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
        $("#add-vote").click(function() {
            var image = $("input[name='image']").val();
            console.log(image);
            if (undefined == image || null == image || '' == image) {
                layer.confirm('请先上传投票图片', {
                    icon: 2,
                    title: '错误',
                    btn: ['确认']
                });
                return false;
            }
            $.ajax({
                type: "POST",
                url:"<?=base_url('admin/vote/add')?>",
                data: $('#main-form').serialize(),
                dataType: "JSON",
                success: function(data) {
                    if(0 == data.status) {
                        layer.confirm('添加投票成功，是否继续添加？', {
                            icon: 1,
                            title: '成功',
                            btn: ['继续添加', '返回列表']
                        }, function(){
                            window.location.reload();
                        }, function(){
                            window.location.href = "<?=base_url('/admin/vote')?>"
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
