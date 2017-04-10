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
<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="exampleModalLabel">账号登录</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <!--<label for="recipient-name" class="control-label">邮箱:</label>-->
                        <input type="email" class="form-control" id="recipient-user" placeholder="邮箱：" required>
                    </div>
                    <div class="form-group">
                        <!--<label for="recipient-name" class="control-label">密码:</label>-->
                        <input type="password" class="form-control" id="recipient-pwd" placeholder="密码：" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer " style="text-align: center;">
                <button type="button" id="loginuser" class="btn btn-primary" style="width:150px;">登录</button>
            </div>
        </div>
    </div>
</div>
<div class="main-content">

    <section id="section-info-selection" class="section section-info-selection">

        <div class="wrapper">
            <article class="product-items">
                <div class="img-container swiper-container gallery-top ">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img class="img" src="/resources/assets/images/ProductImage.png" alt="魔兽世界精美装备!"/>
                        </div>
                        <div class="swiper-slide">
                            <img class="img" src="/resources/assets/images/ProductImage2.png" alt="AmazingFun礼物盒子"/>

                        </div>
                        <div class="swiper-slide">
                            <img class="img" src="/resources/assets/images/ProductImage3.png" alt="逼真的游戏道具"/>
                        </div>
                        <div class="swiper-slide">
                            <img class="img" src="/resources/assets/images/ProductImage4.png" alt="海贼王精美手办"/>
                        </div>
                    </div>
                </div>
                <p class="item-slide-text" id="item-slide-text"></p>
                <div class="swiper-container gallery-thumbs">
                    <div class="swiper-wrapper item-list">
                        <div class="swiper-slide item" >
                            <img class="img" src="/resources/assets/images/ProductImage.png" alt="魔兽世界精美装备!"/>
                        </div>
                        <div class="swiper-slide item">
                            <img class="img" src="/resources/assets/images/ProductImage2.png" alt="AmazingFun礼物盒子"/>
                        </div>
                        <div class="swiper-slide item">
                            <img class="img" src="/resources/assets/images/ProductImage3.png" alt="逼真的游戏道具"/>
                        </div>
                        <div class="swiper-slide item">
                            <img class="img" src="/resources/assets/images/ProductImage4.png" alt="海贼王精美手办"/>
                        </div>
                    </div>
                </div>
            </article>
            <article class="product-info">
                <h1 class="hdr-1">AmazingFun</h1>
                <!--<div id="option-selects-one" class="option-selects">-->
                <h2 class="hdr-5"><label for="plan-select">选择订阅计划</label>
                    <span class="glyphicon glyphicon-info-sign fa-info-circle" data-container="body" data-toggle="popover" data-content="我们的认购计划允许您支付1，3，6或12个月。你可以随时取消。"
                          data-placement="auto top" data-trigger="focus hover" data-original-title="" title=""></span>
                </h2>
                <select class="plan-select" id="plan-select" data-bonus=", Includes FREE bonus t-shirt">
                    <!--<option value="">计划选择</option>-->
                    <!--<option value="ca-1-month-subscription" data-price="40.11" data-period="1" selected>1个月</option>-->
                    <!--<option value="ca-3-month-subscription" data-price="37.50" data-period="3">3个月</option>-->
                    <!--<option value="ca-6-month-subscription" data-price="36.16" data-period="6">6个月</option>-->
                    <!--<option value="ca-12-month-subscription" data-price="34.82" data-period="12">12个月, 包括一件免费奖励T恤</option>-->
                </select> <input type="hidden" id="plan-name" value="ca-1-month-subscription">
                <!--</div>-->
                <div id="option-selects-two" class="option-selects">
                    <h2 class="hdr-5">
                        <label for="size-select-1">选择T恤衫号码</label>
                        <span class="glyphicon glyphicon-info-sign fa-info-circle-t" data-container="body" data-toggle="popover"  data-content=" <img src=&quot;/resources/assets/images/Human_T_Size_Chart.jpg&quot;>" data-trigger="focus hover" data-placement="auto top"  data-html="true" ></span>

                    </h2>
                    <select class="plan-select" id="size-select-1">
                        <option value="">T恤衫号码</option>
                        <option value="33" data-option-type="shirt">男 - S</option>
                        <option value="34" data-option-type="shirt">男 - M</option>
                        <option value="35" data-option-type="shirt">男 - L</option>
                        <option value="36" data-option-type="shirt">男 - XL</option>
                        <option value="37" data-option-type="shirt">男 - 2XL</option>
                        <option value="38" data-option-type="shirt">男 - 3XL</option>
                        <option value="348" data-option-type="shirt">男 - 4XL</option>
                        <option value="349" data-option-type="shirt">男 - 5XL</option>
                        <option value="39" data-option-type="shirt">女 - S</option>
                        <option value="40" data-option-type="shirt">女 - M</option>
                        <option value="41" data-option-type="shirt">女 - L</option>
                        <option value="42" data-option-type="shirt">女 - XL</option>
                        <option value="43" data-option-type="shirt">女 - 2XL</option>
                        <option value="44" data-option-type="shirt">女 - 3XL</option>
                    </select> <input type="hidden" class="option-value" id="shirt" value="">
                </div>
                <p class="pricing">
                    <span class="hdr-3 price price-total">¥222</span>
                    <span class="sub-text currency"></span>
                    <span class="sub-text">/ 月</span>
                </p>

                <p class="shipping hdr-6" style="display: block;">
                    <span class="plus-sh" style="display: none;">包含运费和包装</span>
                    <span class="inc-sh">包含运费和包装</span>
                </p>
                <a class="btn btn-primary" id="btn-header-checkout" href="checkout.html">支付</a>
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
                            <li class="info-item">4-6件物品</li>
                            <li class="info-item">零售价值超400元</li>
                            <li class="info-item">拥有独家授权</li>
                        </ul>
                    </div>
                    <div class="panel">
                        <button class="hdr-3 " id="info-2-btn" data-toggle="collapse" data-target="#info-2"
                                data-parent="#info-accordion" aria-expanded="false" aria-controls="info-2">送货
                        </button>
                        <!--<p class="info collapse in" id="info-2" aria-labelledby="info-2-btn" aria-expanded="false">Your-->
                        <!--crate will arrive between December 20-28 if you order by December 19 at 9pm PT.</p>-->
                        <p class="info collapse " id="info-2" aria-labelledby="info-2-btn" aria-expanded="false">你的盒子将在订购后的一周内送达.</p>
                    </div>
                    <div class="panel">
                        <button class="hdr-3" id="info-3-btn" data-toggle="collapse" data-target="#info-3"
                                data-parent="#info-accordion" aria-expanded="false" aria-controls="info-3">关于主题
                        </button>
                        <p class="info collapse" id="info-3" aria-labelledby="info-3-btn" aria-expanded="false">每个月，我们都会选择一个统一的概念或理念，把这个月的所有
                            和项目。本月的主题是海贼王.</p>
                    </div>
                </div>
            </article>
        </div>
    </section>
    <div style="clear: both"></div>
    <section class="section section-cta-module">
        <div class="wrapper"><h2 class="hdr-2">你还在等什么?</h2>
            <a href="past.html" class="btn btn-primary scroll-link"
               id="link-homepage-bottom-cta">获取Amazing</a>
        </div>
    </section>
    <div class="limited-box"></div>
    <!--<div id="footer-email-capture"><h4>WANT EPIC DEALS &amp; LOOTER INTEL?</h4>-->
    <div id="footer-email-capture"><h4>想要获取AmazingFun吗？</h4>
        <form  method="post" role="form" action="checkout.html" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate form-search newsletter" target="_blank">
            <input type="email" required="" name="email" placeholder="Email" id="footer-mce-email">
            <input type="hidden" value="footer" name="collection_source" class="" id="collection_source">
            <input type="hidden" value="website footer" name="col-source" class="" id="mce-col-source">
            <button type="submit" class="btn btn-primary" id="footer-mc-embedded-subscribe">加入</button>
        </form>
    </div>
</div>
<script src="/resources/assets/js/home/jquery.min.js"></script>
<script src="/resources/assets/js/home/swiper-3.4.0.jquery.min.js"></script>
<script src="/resources/assets/js/home/bootstrap.min.js"></script>
<script src="/resources/assets/js/home/main.js"></script>

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
            console.log(theRequest);
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
        selectprice(a.product);
        $('.product-info .price').text("¥ "+a.price);
        $('#plan-select').change(function(){
            $('.product-info .price').text("¥ "+$(this).children('option:selected').attr("data-price"));
        })
    });
</script>