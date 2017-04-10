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
    <div class="section banner">
        <img src="/resources/assets/images/pastbanner.png" alt="banner"/>
    </div>

    <div class="section section-past-content">
        <div class="wrapper">
            <div class="header-1">

                <h3 class="hdr-3">AMAZING FUN</h3>
                <button class="btn-link" id="toggle-filter-btn">筛选盒子</button>
            </div>
            <aside class="filters">
                <header class="header-2">筛选盒子</header>
                <ul class="filter-list crate-list">
                    <li class="filter-group">
                        <button class="btn-filter selected" id="core-crate-filter-btn"><b class="crate-name">AmazingFun
                            </b> (<span class="crate-count">1</span>)
                        </button>
                        <ul class="filter-sub-list">
                            <li class="filter-year">
                                <button class="btn-filter selected" id="core-crate-2016-filter-btn">2017</button>
                            </li>
                            <!--<li class="filter-year">-->
                            <!--<button class="btn-filter" id="core-crate-2015-filter-btn">2016</button>-->
                            <!--</li>-->
                        </ul>
                    </li>
                    <li class="filter-group">
                        <button class="btn-filter" id="lcdx-crate-filter-btn"><b class="crate-name">AmazingFunDX</b>
                            (<span class="crate-count">1</span>)
                        </button>
                        <ul class="filter-sub-list">
                            <li class="filter-year">
                                <button class="btn-filter" id="lcdx-crate-2016-filter-btn">2017</button>
                            </li>
                        </ul>
                    </li>
                    <li class="filter-group">
                        <button class="btn-filter" id="anime-crate-filter-btn"><b class="crate-name">AmazingFunMIN</b>
                            (<span class="crate-count">1</span>)
                        </button>
                        <ul class="filter-sub-list">
                            <li class="filter-year">
                                <button class="btn-filter" id="anime-crate-2016-filter-btn">2017</button>
                            </li>
                        </ul>
                    </li>
                    <!--<li class="filter-group">-->
                    <!--<button class="btn-filter" id="gaming-crate-filter-btn"><b class="crate-name">LOOT GAMING</b>-->
                    <!--(<span class="crate-count">8</span>)-->
                    <!--</button>-->
                    <!--<ul class="filter-sub-list">-->
                    <!--<li class="filter-year">-->
                    <!--<button class="btn-filter" id="gaming-crate-2016-filter-btn">2016</button>-->
                    <!--</li>-->
                    <!--</ul>-->
                    <!--</li>-->
                    <!--<li class="filter-group">-->
                    <!--<button class="btn-filter" id="pets-crate-filter-btn"><b class="crate-name">LOOT PETS</b> (<span-->
                    <!--class="crate-count">7</span>)-->
                    <!--</button>-->
                    <!--<ul class="filter-sub-list">-->
                    <!--<li class="filter-year">-->
                    <!--<button class="btn-filter" id="pets-crate-2016-filter-btn">2016</button>-->
                    <!--</li>-->
                    <!--</ul>-->
                    <!--</li>-->
                    <!--<li class="filter-group">-->
                    <!--<button class="btn-filter" id="loot-wear-filter-btn"><b class="crate-name">LOOT WEAR</b> (<span-->
                    <!--class="crate-count">10</span>)-->
                    <!--</button>-->
                    <!--<ul class="filter-sub-list">-->
                    <!--<li class="filter-year">-->
                    <!--<button class="btn-filter" id="loot-wear-2016-filter-btn">2016</button>-->
                    <!--</li>-->
                    <!--</ul>-->
                    <!--</li>-->
                    <!--<li class="filter-group">-->
                    <!--<button class="btn-filter" id="halo-crate-filter-btn"><b class="crate-name">HALO LEGENDARY-->
                    <!--CRATE</b> (<span class="crate-count">1</span>)-->
                    <!--</button>-->
                    <!--<ul class="filter-sub-list">-->
                    <!--<li class="filter-year">-->
                    <!--<button class="btn-filter" id="halo-crate-2016-filter-btn">2016</button>-->
                    <!--</li>-->
                    <!--</ul>-->
                    <!--</li>-->
                    <!--<li class="filter-group">-->
                    <!--<button class="btn-filter" id="firefly-crate-filter-btn"><b class="crate-name">FIREFLY CARGO-->
                    <!--CRATE</b> (<span class="crate-count">1</span>)-->
                    <!--</button>-->
                    <!--<ul class="filter-sub-list">-->
                    <!--<li class="filter-year">-->
                    <!--<button class="btn-filter" id="firefly-crate-2016-filter-btn">2016</button>-->
                    <!--</li>-->
                    <!--</ul>-->
                    <!--</li>-->
                </ul>
                <header class="header-2 hide">Filter by Brand</header>
                <ul class="filter-list brand-list hide"></ul>
                <div class="view-more-container hide">
                    <button class="btn-link" id="view-more-brands-btn">View more</button>
                </div>
            </aside>
            <ul class="crates past-slides tabs">
                <li class="tab filtered" data-product="core-crate" data-name="Loot Crate" data-month="january"
                    data-year="2016" data-brands=""
                    style="background-image: url('/resources/assets/images/pastone1.png');">
                    <button id="core-crate-january-2016-tab" class="btn-reset btn-tab"><h6 class="hdr-6"><span>海贼王手办</span><span></span>
                        </h6> <h4 class="hdr-3"><span class="product">AmazingFun</span><span
                                class="date"></span></h4> <h6 class="hdr-6">
                            <span>魔兽世界装备</span><span></span>
                        </h6></button>
                </li>
                <li class="tab filtered" data-product="core-crate" data-name="Loot Crate" data-month="february"
                    data-year="2016" data-brands=""
                    style="background-image: url('/resources/assets/images/pastone2.png');">
                    <button id="core-crate-february-2016-tab" class="btn-reset btn-tab"><h6 class="hdr-6">
                            <span>魔兽世界</span></h6> <h4 class="hdr-3"><span class="product">AmazingFunDX</span><span
                                class="date"></span></h4> <h6 class="hdr-6"><span>Two World One Home</span></h6>
                    </button>
                </li>
                <li class="tab filtered" data-product="core-crate" data-name="Loot Crate" data-month="march"
                    data-year="2016" data-brands=""
                    style="background-image: url('/resources/assets/images/pastone3.png');">
                    <button id="core-crate-march-2016-tab" class="btn-reset btn-tab"><h6 class="hdr-6">
                            <span></span><span>火影忍者</span></h6> <h4 class="hdr-3"><span class="product">AmazingFunMIN</span><span
                                class="date"></span></h4> <h6 class="hdr-6"><span></span><span></span>
                        </h6></button>
                </li>
                <article class="slide swiper-slide" id="core-crate-january-2016-slide" data-product="core-crate"
                         data-name="Loot Crate" data-month="january" data-year="2016"
                         style="background-image: url(https://images.contentful.com/rzwi86gxgpgo/60CbBFw51u2cAkimUqCC2u/31a8c4bbf3bfad9137fb0c67b3153bb3/past-core-invasion-items.jpg);">
                    <div class="slide-container "><h4 class="hdr">本月介绍</h4>

                        <p class="desc">我们把最流行，最炫酷的动漫手办，游戏装备放进您的盒子中，包括海贼王、魔兽世界等更多！</p>

                        <!--<p>-->
                        <!--<a href="//images.contentful.com/rzwi86gxgpgo/YvLCoqkB8W8gyQ2M80Gws/fa3ad1839d93a5692219cc62967e4887/past-core-invasion-download.jpg"-->
                        <!--id="invasion-past-art-download-lnk" class="download-link" download="">Get Theme Art<i-->
                        <!--class="fa fa-download"></i></a></p>-->

                        <p><a href="product.html?product=AmazingFun&price=188"
                              id="invasion-past-purchase-lnk" class="btn btn-primary purchase-link">购买</a></p>
                        <!--<button class="btn-reset btn-view-items" id="invasion-past-btn-view-items"-->
                        <!--data-view-text="View Items" data-hide-text="Hide Items">View Items-->
                        <!--</button>-->
                        <!--<img src="//images.contentful.com/rzwi86gxgpgo/rAOS2nIby8YWwusoSoMQ6/6fbc595d165b9ce117c176dfcccd0e16/past-core-invasion-franchises.png"-->
                        <!--class="img-franchises" alt="">-->
                    </div>
                </article>

            </ul>
        </div>

    </div>
    <section class="section section-cta-module">
        <div class="wrapper"><h2 class="hdr-2">你还在等什么?</h2>
            <a href="past.html" class="btn btn-primary scroll-link"
               id="link-homepage-bottom-cta">获取Amazing</a>
        </div>
    </section>
    <div class="limited-box"></div>
    <!--<div id="footer-email-capture"><h4>WANT EPIC DEALS &amp; LOOTER INTEL?</h4>-->
    <div id="footer-email-capture"><h4>想要获取AmazingFun吗？</h4>

        <form method="post" role="form" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
              class="validate form-search newsletter" target="_blank">
            <input type="email" required="" name="email" placeholder="Email" id="footer-mce-email">
            <input type="hidden" value="footer" name="collection_source" class="" id="collection_source">
            <input type="hidden" value="website footer" name="col-source" class="" id="mce-col-source">
            <button type="submit" class="btn btn-primary" id="footer-mc-embedded-subscribe">加入</button>
        </form>
    </div>
</div>
<div class="footer"></div>
<script src="/resources/assets/js/home/jquery.min.js"></script>
<script src="/resources/assets/js/home/swiper-3.4.0.jquery.min.js"></script>
<script src="/resources/assets/js/home/bootstrap.min.js"></script>
<script src="/resources/assets/js/home/main.js"></script>

<script>
    var mySwiperone = new Swiper('.swiper-one', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
//        pagination: '.swiper-pagination'

    });
    var mySwipertwo = new Swiper('.swiper-two-1', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
//        pagination: '.swiper-pagination'

    });
    $(function () {
        $(".btn-tab").click(function () {
            $(this).toggleClass('active').toggleClass('');
            $(this).parent().siblings('.tab').find('.btn-tab').removeClass('active');
            if($(this).hasClass('active')){
                $('.slide.swiper-slide').show();
            }else{
                $('.slide.swiper-slide').hide();
            }
        });
        $('#toggle-filter-btn').click(function(){
            $('.filters').toggleClass('active').toggleClass('');
        })

    })

</script>