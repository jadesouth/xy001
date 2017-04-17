<link href="<?=base_url()?>resources/assets/libs/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<form id="main-form" class="form-horizontal">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">盒子名称</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?=$data['name']?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="tag" class="col-sm-2 control-label">标签</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?=$data['tag']?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="theme_name" class="col-sm-2 control-label">主题名称</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?=$data['theme_name']?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="year" class="col-sm-2 control-label">年</label>
        <div class="col-sm-9">
            <input type="text" class="form-control"  value="<?=$data['year']?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="month" class="col-sm-2 control-label">月</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?=$data['month']?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="price" class="col-sm-2 control-label">价格</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="¥<?=$data['monthly_price']?> ／ 月" disabled>
            <input type="text" class="form-control" value="¥<?=$data['quarterly_price']?> ／ 3月" disabled>
            <input type="text" class="form-control" value="¥<?=$data['semiannually_price']?> ／ 6月" disabled>
            <input type="text" class="form-control" value="¥<?=$data['annually_price']?> ／ 12月" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="cover_title" class="col-sm-2 control-label">封面标题</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?=$data['cover_title']?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="cover_subtitle" class="col-sm-2 control-label">封面副标题</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?=$data['cover_subtitle']?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="cover_image" class="col-sm-2 control-label">封面图片</label>
        <div class="col-sm-9">
            <img src="<?=$data['cover_image']?>" alt="">
        </div>
    </div>
    <div class="form-group">
        <label for="introduction_title" class="col-sm-2 control-label">介绍</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?=$data['introduction_title']?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="introduction_image" class="col-sm-2 control-label">介绍图片</label>
        <div class="col-sm-9">
            <img src="<?=$data['introduction_image']?>" alt="">
        </div>
    </div>
    <div class="form-group">
        <label for="gift_introduction" class="col-sm-2 control-label">礼物封面介绍</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?=$data['gift_introduction']?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="gift_image" class="col-sm-2 control-label">礼物封面</label>
        <div class="col-sm-9">
            <img src="<?=$data['gift_image']?>" alt="">
        </div>
    </div>
    <div class="form-group">
        <label for="banner_image1" class="col-sm-2 control-label">轮播图1</label>
        <div class="col-sm-9">
            <img src="<?=$data['banner_image1']?>" alt="">
        </div>
    </div>
    <div class="form-group">
        <label for="banner_image2" class="col-sm-2 control-label">轮播图2</label>
        <div class="col-sm-9">
            <img src="<?=$data['banner_image2']?>" alt="">
        </div>
    </div>
    <div class="form-group">
        <label for="banner_image3" class="col-sm-2 control-label">轮播图3</label>
        <div class="col-sm-9">
            <img src="<?=$data['banner_image3']?>" alt="">
        </div>
    </div>
    <div class="form-group">
        <label for="banner_image4" class="col-sm-2 control-label">轮播图4</label>
        <div class="col-sm-9">
            <img src="<?=$data['banner_image4']?>" alt="">
        </div>
    </div>
    <div class="form-group">
        <label for="banner_title1" class="col-sm-2 control-label">轮播图标题1</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?=$data['banner_title1']?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="banner_title2" class="col-sm-2 control-label">轮播图标题2</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?=$data['banner_title2']?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="banner_title3" class="col-sm-2 control-label">轮播图标题3</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?=$data['banner_title3']?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="banner_title4" class="col-sm-2 control-label">轮播图标题4</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?=$data['banner_title4']?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="image1" class="col-sm-2 control-label">物品图1</label>
        <div class="col-sm-9">
            <img src="<?=$data['image1']?>" alt="">
        </div>
    </div>
    <div class="form-group">
        <label for="image2" class="col-sm-2 control-label">物品图2</label>
        <div class="col-sm-9">
            <img src="<?=$data['image2']?>" alt="">
        </div>
    </div>
    <div class="form-group">
        <label for="image3" class="col-sm-2 control-label">物品图3</label>
        <div class="col-sm-9">
            <img src="<?=$data['image3']?>" alt="">
        </div>
    </div>
    <div class="form-group">
        <label for="image4" class="col-sm-2 control-label">物品图4</label>
        <div class="col-sm-9">
            <img src="<?=$data['image4']?>" alt="">
        </div>
    </div>
    <div class="form-group">
        <label for="characteristic" class="col-sm-2 control-label">特征</label>
        <div class="col-sm-9">
            <textarea class="form-control" rows="12" placeholder="文章内容" disabled><?=$data['characteristic']?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="logistics" class="col-sm-2 control-label">送货</label>
        <div class="col-sm-9">
            <textarea class="form-control" rows="12" placeholder="文章内容" disabled><?=$data['logistics']?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="about" class="col-sm-2 control-label">关于主题</label>
        <div class="col-sm-9">
            <textarea class="form-control" rows="12" placeholder="文章内容" disabled><?=$data['about']?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="created_at" class="col-sm-2 control-label">发布时间</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?=$data['created_at']?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <a href="/admin/box/"><button id="main-submit" type="button" class="btn btn-primary btn-lg btn-block">返回列表</button></a>
        </div>
    </div>
</form>