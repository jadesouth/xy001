<style>
    .swiper-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
        z-index: 1;
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-transition-property: -webkit-transform;
        -moz-transition-property: -moz-transform;
        -o-transition-property: -o-transform;
        -ms-transition-property: -ms-transform;
        transition-property: transform;
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
    }
    .section-info-selection .product-items .img-container {
        overflow: hidden;
        width: 100%;
    }
    .gallery-top img{width:100%;}
    .popover-content img{
        width: 100%;}
</style>
<div class="main-content">

    <section id="section-info-selection" class="section section-info-selection">

        <div class="wrapper">
            <article class="product-items">
                <div class="img-container swiper-container gallery-top ">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img class="img" src="<?=$box_info['banner_image1']?>" alt="<?=$box_info['banner_title1']?>"/>
                        </div>
                        <div class="swiper-slide">
                            <img class="img" src="<?=$box_info['banner_image2']?>" alt="<?=$box_info['banner_title2']?>"/>

                        </div>
                        <div class="swiper-slide">
                            <img class="img" src="<?=$box_info['banner_image3']?>" alt="<?=$box_info['banner_title3']?>"/>
                        </div>
                        <div class="swiper-slide">
                            <img class="img" src="<?=$box_info['banner_image4']?>" alt="<?=$box_info['banner_title4']?>"/>
                        </div>
                    </div>
                </div>
                <p class="item-slide-text" id="item-slide-text"><?=$box_info['banner_title1']?></p>
                <div class="swiper-container gallery-thumbs">
                    <div class="swiper-wrapper item-list">
                        <div class="swiper-slide item" >
                            <img class="img" src="<?=$box_info['banner_image1']?>" alt="<?=$box_info['banner_title1']?>"/>
                        </div>
                        <div class="swiper-slide item">
                            <img class="img" src="<?=$box_info['banner_image2']?>" alt="<?=$box_info['banner_title2']?>"/>
                        </div>
                        <div class="swiper-slide item">
                            <img class="img" src="<?=$box_info['banner_image3']?>" alt="<?=$box_info['banner_title3']?>"/>
                        </div>
                        <div class="swiper-slide item">
                            <img class="img" src="<?=$box_info['banner_image4']?>" alt="<?=$box_info['banner_title4']?>"/>
                        </div>
                    </div>
                </div>
            </article>
            <article class="product-info">
                <h1 class="hdr-1"><?=$box_info['theme_name']?></h1>
                <div id="option-selects-one" class="option-selects">
                <h2 class="hdr-5"><label for="plan-select">选择订阅计划</label>
                    <span class="glyphicon glyphicon-info-sign fa-info-circle" data-container="body" data-toggle="popover" data-content="我们的认购计划允许您支付1，3，6或12个月。你可以随时取消。"
                          data-placement="auto top" data-trigger="focus hover" data-original-title="" title=""></span>
                </h2>
                <select class="plan-select" id="plan-select" data-bonus=", Includes FREE bonus t-shirt">
                    <option value="1" data-price="<?=$box_info['monthly_price']?>" data-period="1" selected>1个月</option>
                    <option value="3" data-price="<?=$box_info['quarterly_price']?>" data-period="3">3个月</option>
                    <option value="6" data-price="<?=$box_info['semiannually_price']?>" data-period="6">6个月</option>
                    <option value="12" data-price="<?=$box_info['annually_price']?>" data-period="12">12个月, 包括一件免费奖励T恤</option>
                </select>
                </div>
                <div id="option-selects-two" class="option-selects">
                    <h2 class="hdr-5">
                        <label for="size-select-1">选择T恤衫号码</label>
                        <span class="glyphicon glyphicon-info-sign fa-info-circle-t" data-container="body" data-toggle="popover"  data-content=" <img src=&quot;/resources/assets/images/Human_T_Size_Chart.jpg&quot;>" data-trigger="focus hover" data-placement="auto top"  data-html="true" ></span>

                    </h2>
                    <select class="plan-select" id="size-select-1">
                        <option value="">T恤衫号码</option>
                        <option value="1-S" data-option-type="shirt">男 - S</option>
                        <option value="1-M" data-option-type="shirt">男 - M</option>
                        <option value="1-L" data-option-type="shirt">男 - L</option>
                        <option value="1-XL" data-option-type="shirt">男 - XL</option>
                        <option value="1-2XL" data-option-type="shirt">男 - 2XL</option>
                        <option value="1-3XL" data-option-type="shirt">男 - 3XL</option>
                        <option value="1-4XL" data-option-type="shirt">男 - 4XL</option>
                        <option value="1-5XL" data-option-type="shirt">男 - 5XL</option>
                        <option value="2-S" data-option-type="shirt">女 - S</option>
                        <option value="2-M" data-option-type="shirt">女 - M</option>
                        <option value="2-L" data-option-type="shirt">女 - L</option>
                        <option value="2-XL" data-option-type="shirt">女 - XL</option>
                        <option value="2-2XL" data-option-type="shirt">女 - 2XL</option>
                        <option value="2-3XL" data-option-type="shirt">女 - 3XL</option>
                    </select> <input type="hidden" class="option-value" id="shirt" value="">
                </div>
                <p class="pricing">
                    <span class="hdr-3 price price-total">¥<?=$box_info['monthly_price']?></span>
                    <span class="sub-text currency"></span>
                    <span class="sub-text monthly">/ 月</span>
                </p>

                <p class="shipping hdr-6" style="display: block;">
                    <span class="plus-sh" style="display: none;">包含运费和包装</span>
                    <span class="inc-sh">包含运费和包装</span>
                </p>
                <a class="btn btn-primary" id="btn-header-checkout">支付</a>
                <!--<button class="btn btn-primary btn-cross-sell" id="btn-header-checkout-cs" data-toggle="modal"-->
                <!--data-target="#crossModal" data-url="" data-options="" disabled="">Check Out-->
                <!--</button>-->
                <div class="info-container" id="info-accordion">
                    <div class="panel">
                        <button class="hdr-3" id="info-1-btn" data-toggle="collapse" data-target="#info-1"
                                data-parent="#info-accordion" aria-expanded="false" aria-controls="info-1">特征
                        </button>
                        <ul class="info-list collapse" id="info-1" aria-labelledby="info-1-btn" aria-expanded="false"
                            style="height: 0px;">
                            <?php $characteristic = explode("\n",$box_info['characteristic']);?>
                            <?php foreach ($characteristic as $characteristic_value){?>
                            <li class="info-item"><?=$characteristic_value?></li>
                            <?php }?>
                        </ul>
                    </div>
                    <div class="panel">
                        <button class="hdr-3 " id="info-2-btn" data-toggle="collapse" data-target="#info-2"
                                data-parent="#info-accordion" aria-expanded="false" aria-controls="info-2">送货
                        </button>
                        <!--<p class="info collapse in" id="info-2" aria-labelledby="info-2-btn" aria-expanded="false">Your-->
                        <!--crate will arrive between December 20-28 if you order by December 19 at 9pm PT.</p>-->
                        <p class="info collapse " id="info-2" aria-labelledby="info-2-btn" aria-expanded="false"><?=$box_info['logistics']?></p>
                    </div>
                    <div class="panel">
                        <button class="hdr-3" id="info-3-btn" data-toggle="collapse" data-target="#info-3"
                                data-parent="#info-accordion" aria-expanded="false" aria-controls="info-3">关于主题
                        </button>
                        <p class="info collapse" id="info-3" aria-labelledby="info-3-btn" aria-expanded="false"><?=$box_info['about']?></p>
                    </div>
                </div>
            </article>
        </div>
    </section>
    <div style="clear: both"></div>
    <section class="section section-cta-module">
        <div class="wrapper"><h2 class="hdr-2">你还在等什么?</h2>
            <a href="/product/all" class="btn btn-primary scroll-link"
               id="link-homepage-bottom-cta">获取Amazing</a>
        </div>
    </section>
    <div class="limited-box"></div>
</div>
<script src="/resources/assets/js/home/jquery.min.js"></script>
<script src="/resources/assets/js/home/swiper-3.4.0.jquery.min.js"></script>
<script src="/resources/assets/js/home/bootstrap.min.js"></script>
<script src="/resources/assets/js/home/main.js"></script>
<script src="/resources/assets/libs/layui/layui.js" type="application/javascript"></script>

<script>

    var galleryTop = new Swiper('.gallery-top', {
        spaceBetween: 10,
        loop:true,
        loopedSlides: 4, //looped slides should be the same
    });
    var galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 10,
        slidesPerView: 4,
        touchRatio: 0.2,
        loop:true,
        loopedSlides: 4, //looped slides should be the same
        slideToClickedSlide: true
    });
    galleryTop.params.control = galleryThumbs;
    galleryThumbs.params.control = galleryTop;

    $(function(){
        // 加载layer
        layui.use('layer', function () {
            var layer = layui.layer;
        });
        $('.item').click(function(){
            $('#item-slide-text').html( $(this).find('img').attr('alt'));
        });
//    $("[data-toggle='popover']").popover();
//    $('.collapse').collapse();

        function GetRequest() {
            var url = location.search; //获取url中"?"符后的字串
            var theRequest = new Object();
            if (url.indexOf("?") != -1) {
                var str = url.substr(1);
                strs = str.split("&");
                for (var i = 0; i < strs.length; i++) {
                    theRequest[strs[i].split("=")[0]] = decodeURIComponent(strs[i].split("=")[1]);
                }
            }
            return theRequest;
        }
        var funstr='<option value="">计划选择</option><option value="ca-1-month-subscription" data-price="188" data-period="1" selected>1个月</option>'+
            '<option value="ca-3-month-subscription" data-price="178" data-period="3">3个月</option>'+
            '<option value="ca-6-month-subscription" data-price="168" data-period="6">6个月</option>'+
            '<option value="ca-12-month-subscription" data-price="158" data-period="12">12个月, 包括一件免费奖励T恤</option>';
        var fundxstr='<option value="">计划选择</option><option value="ca-1-month-subscription" data-price="499" data-period="1" selected>1个月</option>'+
            '<option value="ca-3-month-subscription" data-price="489" data-period="3">3个月</option>'+
            '<option value="ca-6-month-subscription" data-price="479" data-period="6">6个月</option>'+
            '<option value="ca-12-month-subscription" data-price="469" data-period="12">12个月, 包括一件免费奖励T恤</option>';
        var funminstr='<option value="">计划选择</option><option value="ca-1-month-subscription" data-price="109" data-period="1" selected>1个月</option>'+
            '<option value="ca-3-month-subscription" data-price="99" data-period="3">3个月</option>'+
            '<option value="ca-6-month-subscription" data-price="89" data-period="6">6个月</option>'+
            '<option value="ca-12-month-subscription" data-price="79" data-period="12">12个月, 包括一件免费奖励T恤</option>';

        function selectprice(productprice){
            switch(productprice){
                case "AmazingFun":$('#plan-select').append(funstr);
                    break;
                case "AmazingFunDX":$('#plan-select').append(fundxstr);
                    break;
                case "AmazingFunMIN":$('#plan-select').append(funminstr);
                    break;
            }
        }
        GetRequest();
        var a=GetRequest();
        $('.product-info h1').text(a.product);
//        selectprice(a.product);
//        $('.product-info .price').text("¥ "+a.price);
        $('#plan-select').change(function () {
            $('.product-info .price').text("¥ " + $(this).children('option:selected').attr("data-price"));
            $('.product-info .monthly').text("/" + $(this).children('option:selected').val() + 月);
        })

        $('#btn-header-checkout').on('click', function () {
            var plan = $('#plan-select').val();//订阅计划
            var tSize = $('#size-select-1').val();
            if(tSize == ''){
                layer.alert('请选择T恤衫号码', {icon: 2});
                return false;
            }
            window.location.href = '/product/checkout?id=<?=$box_info['id']?>&plan='+plan+'&tsize='+tSize;
        });
    });
</script>