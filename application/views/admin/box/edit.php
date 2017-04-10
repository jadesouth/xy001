<script type="text/javascript" src="<?=base_url()?>resources/assets/libs/jquery-fileupload/jquery-ui.js"></script>
<script type="text/javascript" src="<?=base_url()?>resources/assets/libs/jquery-fileupload/jquery.fileupload.js"></script>

<!--提示弹出-->
<div id="main-warning" class="alert alert-danger alert-dismissible col-sm-11" style="display:none" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p class="lead label label-danger">Warning!</p><br/><br/>
    <div></div>
</div>
<form id="main-form" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">盒子名称</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="name"  placeholder="盒子名称" value="<?=$data['name']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="theme_name" class="col-sm-2 control-label">主题</label>
        <div class="col-sm-9">
            <select class="form-control" name="theme">
                <option value="">请选择主题</option>
                <?php foreach ($theme_data as $theme) :?>
                    <?php if($data['theme_id'] == $theme['id']) {?>
                        <option value="<?=$theme['id']?>-<?=$theme['name']?>" selected><?=$theme['name']?></option>
                    <?php }else{?>
                        <option value="<?=$theme['id']?>-<?=$theme['name']?>"><?=$theme['name']?></option>
                    <?php }?>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="year" class="col-sm-2 control-label">年</label>
        <div class="col-sm-9">
            <input type="text" class="form-control"  name="year" placeholder="请输入年,如2017" value="<?=$data['year']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="month" class="col-sm-2 control-label">月</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="month" placeholder="请输入月,如1" value="<?=$data['month']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="price" class="col-sm-2 control-label">价格</label>
        <div class="col-sm-9">
            1月价格:<input type="text" class="form-control" name="monthly_price" placeholder="请输入价格,如0.00" value="<?=$data['monthly_price']?>">
            3月价格:<input type="text" class="form-control" name="quarterly_price" placeholder="请输入价格,如0.00" value="<?=$data['quarterly_price']?>">
            6月价格:<input type="text" class="form-control" name="semiannually_price" placeholder="请输入价格,如0.00" value="<?=$data['semiannually_price']?>">
            12月价格:<input type="text" class="form-control" name="annually_price" placeholder="请输入价格,如0.00" value="<?=$data['annually_price']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="cover_title" class="col-sm-2 control-label">封面标题</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="cover_title" placeholder="请输入封面标题" value="<?=$data['cover_title']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="cover_subtitle" class="col-sm-2 control-label">封面副标题</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="cover_subtitle" placeholder="请输入封面副标题" value="<?=$data['cover_subtitle']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="cover_image" class="col-sm-2 control-label">封面图片</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" name="cover_image" id="cover_image" placeholder="请上传封面图片">
            <input type="hidden" name="cover_image_url" value="<?=$data['cover_image']?>">
            <img class="img-thumbnail" style="display:block" src="<?=$data['cover_image']?>">
            <p class="help-block">支持jpg、jpeg、png、gif格式，大小不超过4.0M</p>
        </div>
    </div>
    <div class="form-group">
        <label for="introduction_title" class="col-sm-2 control-label">介绍</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="introduction_title" placeholder="" value="<?=$data['introduction_title']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="introduction_image" class="col-sm-2 control-label">介绍图片</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" name="introduction_image" id="introduction_image" placeholder="" value="<?=$data['introduction_image']?>">
            <input type="hidden" name="introduction_image_url" value="<?=$data['introduction_image']?>">
            <img class="img-thumbnail" style="display: block" src="<?=$data['introduction_image']?>">
            <p class="help-block">支持jpg、jpeg、png、gif格式，大小不超过4.0M</p>
        </div>
    </div>
    <div class="form-group">
        <label for="gift_introduction" class="col-sm-2 control-label">礼物封面介绍</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="gift_introduction" placeholder="" value="<?=$data['gift_introduction']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="gift_image" class="col-sm-2 control-label">礼物封面</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" name="gift_image" id="gift_image" placeholder="">
            <input type="hidden" name="gift_image_url" value="<?=$data['gift_image']?>">
            <img class="img-thumbnail" style="display: block" src="<?=$data['gift_image']?>">
            <p class="help-block">支持jpg、jpeg、png、gif格式，大小不超过4.0M</p>
        </div>
    </div>
    <div class="form-group">
        <label for="bannber_image1" class="col-sm-2 control-label">轮播图1</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" name="bannber_image1" id="bannber_image1" placeholder="">
            <input type="hidden" name="bannber_image1_url" value="<?=$data['bannber_image1']?>">
            <img class="img-thumbnail" style="display: block" src="<?=$data['bannber_image1']?>">
            <p class="help-block">支持jpg、jpeg、png、gif格式，大小不超过4.0M</p>
        </div>
    </div>
    <div class="form-group">
        <label for="bannber_image2" class="col-sm-2 control-label">轮播图2</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" name="bannber_image2" id="bannber_image2" placeholder="">
            <input type="hidden" name="bannber_image2_url" value="<?=$data['bannber_image2']?>">
            <img class="img-thumbnail" style="display: block" src="<?=$data['bannber_image2']?>">
            <p class="help-block">支持jpg、jpeg、png、gif格式，大小不超过4.0M</p>
        </div>
    </div>
    <div class="form-group">
        <label for="bannber_image3" class="col-sm-2 control-label">轮播图3</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" name="bannber_image3" id="bannber_image3" placeholder="">
            <input type="hidden" name="bannber_image3_url" value="<?=$data['bannber_image3']?>">
            <img class="img-thumbnail" style="display: block" src="<?=$data['bannber_image3']?>">
            <p class="help-block">支持jpg、jpeg、png、gif格式，大小不超过4.0M</p>
        </div>
    </div>
    <div class="form-group">
        <label for="bannber_image4" class="col-sm-2 control-label">轮播图4</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" name="bannber_image4" id="bannber_image4" placeholder="">
            <input type="hidden" name="bannber_image4_url" value="<?=$data['bannber_image4']?>">
            <img class="img-thumbnail" style="display: block" src="<?=$data['bannber_image4']?>">
            <p class="help-block">支持jpg、jpeg、png、gif格式，大小不超过4.0M</p>
        </div>
    </div>
    <div class="form-group">
        <label for="bannber_title1" class="col-sm-2 control-label">轮播图标题1</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="bannber_title1" placeholder="" value="<?=$data['bannber_title1']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="bannber_title2" class="col-sm-2 control-label">轮播图标题2</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="bannber_title2" placeholder="" value="<?=$data['bannber_title2']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="bannber_title3" class="col-sm-2 control-label">轮播图标题3</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="bannber_title3" placeholder="" value="<?=$data['bannber_title3']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="bannber_title4" class="col-sm-2 control-label">轮播图标题4</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="bannber_title4" placeholder="" value="<?=$data['bannber_title4']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="image1" class="col-sm-2 control-label">物品图1</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" name="image1" id="image1" placeholder="">
            <input type="hidden" name="image1_url" value="<?=$data['image1']?>">
            <img class="img-thumbnail" style="display: block" src="<?=$data['image1']?>">
            <p class="help-block">支持jpg、jpeg、png、gif格式，大小不超过4.0M</p>
        </div>
    </div>
    <div class="form-group">
        <label for="image2" class="col-sm-2 control-label">物品图2</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" name="image2" id="image2" placeholder="">
            <input type="hidden" name="image2_url" value="<?=$data['image2']?>">
            <img class="img-thumbnail" style="display: block" src="<?=$data['image2']?>">
            <p class="help-block">支持jpg、jpeg、png、gif格式，大小不超过4.0M</p>
        </div>
    </div>
    <div class="form-group">
        <label for="image3" class="col-sm-2 control-label">物品图3</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" name="image3" id="image3" placeholder="">
            <input type="hidden" name="image3_url" value="<?=$data['image3']?>">
            <img class="img-thumbnail" style="display: block" src="<?=$data['image3']?>">
            <p class="help-block">支持jpg、jpeg、png、gif格式，大小不超过4.0M</p>
        </div>
    </div>
    <div class="form-group">
        <label for="image4" class="col-sm-2 control-label">物品图4</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" name="image4" id="image4" placeholder="">
            <input type="hidden" name="image4_url" value="<?=$data['image4']?>">
            <img class="img-thumbnail" style="display: block" src="<?=$data['image4']?>">
            <p class="help-block">支持jpg、jpeg、png、gif格式，大小不超过4.0M</p>
        </div>
    </div>
    <div class="form-group">
        <label for="characteristic" class="col-sm-2 control-label">特征</label>
        <div class="col-sm-9">
            <textarea class="form-control" rows="12" placeholder="特征" name="characteristic"><?=$data['characteristic']?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="logistics" class="col-sm-2 control-label">送货</label>
        <div class="col-sm-9">
            <textarea class="form-control" rows="12" placeholder="送货" name="logistics"><?=$data['logistics']?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="about" class="col-sm-2 control-label">关于主题</label>
        <div class="col-sm-9">
            <textarea class="form-control" rows="12" placeholder="关于主题" name="about"><?=$data['about']?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <button id="main-submit" type="button" class="btn btn-primary btn-lg btn-block">确定修改</button>
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
                <a href="<?=base_url('/admin/box/index')?>" type="button" class="btn btn-default">返回列表</a>
                <a href="<?=base_url('/admin/box/edit/'.$data['id'])?>" type="button" class="btn btn-primary">继续修改</a>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url()?>resources/assets/libs/layui/layui.js" type="application/javascript"></script>
<script type="application/javascript">
    $(function () {
        layui.use('layer', function(){
            var layer = layui.layer;
        });
        function box_upload_image(image_name){
            var uploader  = $("#"+image_name );
            uploader .fileupload({
                autoUpload: true,
                url: "/upload/image",
                dataType: 'json',
                done: function (e, data) {
                    if (0 == data.result.status) {
                        var image_ele_name = image_name+'_url';
                        $("input[name="+image_ele_name+"]").val(data.result.data.image_url);
                        $("input[name="+image_ele_name+"]").next('img').attr('src',data.result.data.image_url);
                    } else {
                        console.log(layer);
                        layer.alert(1111);
                        layer.alert(data.result.msg, {icon: 2});
                    }
                }
            });
        }
        box_upload_image("cover_image"); // 上传封面图片
        box_upload_image("introduction_image"); // 上传介绍图片
        box_upload_image("bannber_image1");
        box_upload_image("bannber_image2");
        box_upload_image("bannber_image3");
        box_upload_image("bannber_image4");
        box_upload_image("gift_image");
        box_upload_image("image1");
        box_upload_image("image2");
        box_upload_image("image3");
        box_upload_image("image4");
    });
    $('#main-submit').click(function(){
        $.ajax({
            type: "POST",
            url: "/admin/box/edit/<?=$data['id']?>",
            data: $("#main-form").serialize(),
            dataType: "json",
            success: function(response){
                if(0 == response.status) {
                    if("" !== response.msg) {
                        $("#success-msg").html(response.msg);
                    }
                    $('#main-modal').modal({backdrop: 'static', keyboard: false});
                } else {
                    $("#main-warning > div").html(response.msg);
                    layer.open({
                        type: 1,
                        title: false,
                        closeBtn: 0,
                        area: '516px',
                        skin: 'layui-layer-nobg', //没有背景色
                        shadeClose: true,
                        content: $('#main-warning')
                    });
                }
            }
        });
    });
</script>