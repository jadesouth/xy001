<div class="main-content">
    <div class="section banner">
        <img src="/resources/assets/images/banner.png" alt="banner"/>
    </div>
    <div class="section introduce">
        <div class="wrapper">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="hdr-2"> 我们是谁</h2>

                    <p class="desc">
                        在AmazingFun 我们每个月会推出一款神秘盒子，生活中应该有惊喜我们为你制造惊喜
                    </p>
                </div>
            </div>

            <ul class="value-list">
                <li class="value">
                    <img src="/resources/assets/images/value-icon-01.png" alt="" class="value-icon"/>
                    <h4>很酷的收藏品</h4>

                    <p class="desc">最好和最独家的礼品，T恤衫，家居用品，以及更多！</p>
                </li>
                <li class="value">
                    <img src="/resources/assets/images/value-icon-02.png" alt="" class="value-icon"/>
                    <h4>神秘的礼物</h4>

                    <p class="desc">每月为自己或者为你的朋友和爱人送出一份礼物</p>
                </li>
                <li class="value">
                    <img src="/resources/assets/images/value-icon-03.png" alt="" class="value-icon"/>
                    <h4>随时取消</h4>

                    <p class="desc">你可以随时跳过某一期盒子，再从你喜欢的礼物开始</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="section section-whats-in-a-crate">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <div class="copy">
                        <h2 class="hdr-2">盒子里有什么？</h2>

                        <p class="desc">
                            我们会按照主题选择好玩 有趣的单品放入盒子，每月为你送上门。当然你也可以定制哦。
                        </p>
                    </div>
                    <div class="carousel"><h4 class="hdr-4"></h4>

                        <div class="swiper-container items swiper-container-horizontal swiper-one">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><img
                                        src="/resources/assets/images/homepage-whats-item-01-opt.png"
                                        alt="海贼王手办">

                                    <p class="hdr-5">海贼王手办</p></div>
                                <div class="swiper-slide"><img
                                        src="/resources/assets/images/homepage-whats-item-02-opt.png"
                                        alt="T-Shirt">

                                    <p class="hdr-5">T恤衫</p></div>
                                <div class="swiper-slide ">
                                    <img src="/resources/assets/images/homepage-whats-item-03-opt.png"
                                         alt="游戏装备">

                                    <p class="hdr-5">游戏装备</p></div>
                                <div class="swiper-slide ">
                                    <img src="/resources/assets/images/homepage-whats-item-04-opt.png"
                                         alt="Shredder Sunglasses">

                                    <p class="hdr-5">游戏装备</p></div>
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-md-9 img-container">
                    <img src="/resources/assets/images/showimg.png" alt="" class="whatsinacrate-img"/>

                    <div class="copy mobile">
                        <p class="desc">我们会按照主题选择好玩 有趣的单品放入盒子，每月为你送上门。当然你也可以定制哦。</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="section section-monthly">
        <div class="wrapper">
            <div class="row header-1">
                <div class="col-xs-12">
                    <h3 class="hdr-3">每一个特色盒子！</h3>
                    <h5 class="hdr-5">每月推出一个新的主题!</h5>
                    <!--<a href="#" class="fr">Shop All Crates</a>-->
                </div>
            </div>
            <div class="row monthly-main">
                <div class="col-sm-4 col-xs-12 ">
                    <div class="crate-one">
                        <div class="crate-hdr">
                            <h5 class="hdr-5">每月神秘的游戏设备</h5>

                        </div>
                        <div class="crate-one-down">
                            <h5 class="hdr-5 ">往期物品</h5>

                            <div class="swiper-container swiper-two-1 mt10">
                                <div class="swiper-wrapper">
                                    <?php if(!empty($box_list[1]['image1'])):?>
                                    <div class="swiper-slide">
                                        <img src="<?=$box_list[1]['image1']?>" alt="" class="item"/>
                                    </div>
                                    <?php endif;?>
                                    <?php if(!empty($box_list[1]['image2'])):?>
                                    <div class="swiper-slide">
                                        <img src="<?=$box_list[1]['image2']?>" alt="" class="item"/>
                                    </div>
                                    <?php endif;?>
                                    <?php if(!empty($box_list[1]['image3'])):?>
                                    <div class="swiper-slide">
                                        <img src="<?=$box_list[1]['image3']?>" alt="" class="item"/>
                                    </div>
                                    <?php endif;?>
                                    <?php if(!empty($box_list[1]['image4'])):?>
                                    <div class="swiper-slide">
                                        <img src="<?=$box_list[1]['image4']?>" alt="" class="item"/>
                                    </div>
                                    <?php endif;?>
                                </div>
                                <!-- 如果需要分页器 -->
                                <div class="swiper-pagination"></div>

                                <!-- 如果需要导航按钮 -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                            <div class="crate-info">
                                <p>¥<?=$box_list[1]['monthly_price']?>/月 包含运费</p>
                                <a href="/product.html?theme_id=<?=$box_list[1]['theme_id']?>&id=<?=$box_list[1]['id']?>" class="btn btn-primary"
                                   data-product="AmazingFun">Get AmazingFun</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-4 col-xs-12 ">
                    <div class="crate-two">
                        <div class="crate-hdr ">
                            <h5 class="hdr-5">优质的独家收藏品和服装</h5>
                        </div>
                        <div class="crate-one-down">
                            <h5 class="hdr-5 ">往期物品</h5>

                            <div class="swiper-container swiper-two-2 mt10">
                                <div class="swiper-wrapper">
                                    <?php if(!empty($box_list[2]['image1'])):?>
                                        <div class="swiper-slide">
                                            <img src="<?=$box_list[2]['image1']?>" alt="" class="item"/>
                                        </div>
                                    <?php endif;?>
                                    <?php if(!empty($box_list[2]['image2'])):?>
                                        <div class="swiper-slide">
                                            <img src="<?=$box_list[2]['image2']?>" alt="" class="item"/>
                                        </div>
                                    <?php endif;?>
                                    <?php if(!empty($box_list[2]['image3'])):?>
                                        <div class="swiper-slide">
                                            <img src="<?=$box_list[2]['image3']?>" alt="" class="item"/>
                                        </div>
                                    <?php endif;?>
                                    <?php if(!empty($box_list[2]['image4'])):?>
                                        <div class="swiper-slide">
                                            <img src="<?=$box_list[2]['image4']?>" alt="" class="item"/>
                                        </div>
                                    <?php endif;?>
                                </div>
                                <!-- 如果需要分页器 -->
                                <div class="swiper-pagination"></div>

                                <!-- 如果需要导航按钮 -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                            <div class="crate-info">
                                <p>¥<?=$box_list[2]['monthly_price']?>/月 包含运费</p>
                                <a href="/product.html?theme_id=<?=$box_list[2]['theme_id']?>&id=<?=$box_list[2]['id']?>" class="btn btn-primary"
                                   data-product="AmazingFunDX">Get AmazingFunDX</a>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-sm-4 col-xs-12 ">
                    <div class="crate-three">
                        <div class="crate-hdr">
                            <h5 class="hdr-5">极好的服饰，袜子，T恤和更多</h5>
                        </div>
                        <div class="crate-one-down">
                            <h5 class="hdr-5 ">往期物品</h5>

                            <div class="swiper-container swiper-two-3 mt10">
                                <div class="swiper-wrapper">
                                    <?php if(!empty($box_list[3]['image1'])):?>
                                        <div class="swiper-slide">
                                            <img src="<?=$box_list[3]['image1']?>" alt="" class="item"/>
                                        </div>
                                    <?php endif;?>
                                    <?php if(!empty($box_list[3]['image2'])):?>
                                        <div class="swiper-slide">
                                            <img src="<?=$box_list[3]['image2']?>" alt="" class="item"/>
                                        </div>
                                    <?php endif;?>
                                    <?php if(!empty($box_list[3]['image3'])):?>
                                        <div class="swiper-slide">
                                            <img src="<?=$box_list[3]['image3']?>" alt="" class="item"/>
                                        </div>
                                    <?php endif;?>
                                    <?php if(!empty($box_list[3]['image4'])):?>
                                        <div class="swiper-slide">
                                            <img src="<?=$box_list[3]['image4']?>" alt="" class="item"/>
                                        </div>
                                    <?php endif;?>
                                </div>
                                <!-- 如果需要分页器 -->
                                <div class="swiper-pagination"></div>

                                <!-- 如果需要导航按钮 -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                            <div class="crate-info">
                                <p>¥<?=$box_list[3]['monthly_price']?>/月 包含运费</p>
                                <a href="/product.html?theme_id=<?=$box_list[3]['theme_id']?>&id=<?=$box_list[3]['id']?>" class="btn btn-primary"
                                   data-product="AmazingFunMIN">Get AmazingFunMIN</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <section class="section section-fan-wall">
        <div class="wrapper">
            <div class="row header-1">
                <div class="col-xs-12">
                    <!--<h2 class="hdr-2">Looter Fan Wall</h2>-->
                    <h2 class="hdr-2">展示墙</h2>

                    <p class="desc">炫耀你的战利品在你的微博，朋友圈</p>

                </div>
            </div>
        </div>
    </section>
    <section class="section section-cta-module">
        <div class="wrapper"><h2 class="hdr-2">你还在等什么? 快加入我们！</h2>
            <a href="allcrate.html" class="btn btn-primary scroll-link"
               id="link-homepage-bottom-cta">Get Amazing</a>
        </div>
    </section>
    <div class="limited-box"></div>
    <div id="footer-email-capture"><h4>想要获取AmazingFun吗？</h4>

        <form method="post" role="form" action="" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
              class="validate form-search newsletter" target="_blank">
            <input type="email" required="" name="email" placeholder="Email" id="footer-mce-email">
            <input type="hidden" value="footer" name="collection_source" class="" id="collection_source">
            <input type="hidden" value="website footer" name="col-source" class="" id="mce-col-source">
            <button type="submit" class="btn btn-primary" id="footer-mc-embedded-subscribe"><a
                    href="checkout.html">加入</a></button>
        </form>
    </div>
</div>
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
    var mySwipertwo1 = new Swiper('.swiper-two-1', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
//        pagination: '.swiper-pagination'

    });
    var mySwipertwo2 = new Swiper('.swiper-two-2', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
//        pagination: '.swiper-pagination'

    });
    var mySwipertwo3 = new Swiper('.swiper-two-3', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
//        pagination: '.swiper-pagination'

    });
</script>
