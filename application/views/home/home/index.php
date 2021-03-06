<div class="main-content">

 <div class="swiper-container bannerSwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide banner">
                <img src="/resources/assets/images/bannernew5.png" alt="HIPHOP"/>
            </div>
            <div class="swiper-slide banner">
                <img src="/resources/assets/images/bannernew1.png" alt="AmazingFun"/>
            </div>
            <div class="swiper-slide banner">
                <img src="/resources/assets/images/indexbanner2.png" alt="Girl"/>
            </div>
            <div class="swiper-slide banner">
                <img src="/resources/assets/images/bannernew3.png" alt="banner"/>
            </div>
        </div>
        <!-- 如果需要导航按钮 -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
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

                    <p class="desc">最好和最独家的礼品，T恤衫，生活用品，以及更多！</p>
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
                            我们会按照主题选择好玩 有趣的单品放入盒子，每月为你送上门。
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
                                        src="/resources/assets/images/homepage-whats-item-02-opt-new.png"
                                        alt="T-Shirt">

                                    <p class="hdr-5">服装</p></div>
                                <div class="swiper-slide ">
                                    <img src="/resources/assets/images/homepage-whats-item-03-opt-new.png"
                                         alt="游戏装备">

                                    <p class="hdr-5">游戏装备</p></div>
                                <div class="swiper-slide ">
                                    <img src="/resources/assets/images/homepage-whats-item-04-opt-new.png"
                                         alt="Shredder Sunglasses">

                                    <p class="hdr-5">精美礼品</p></div>
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-md-9 img-container">
                    <img src="/resources/assets/images/showimgnew.png" alt="" class="whatsinacrate-img"/>

                    <div class="copy mobile">
                        <p class="desc">我们会按照主题选择好玩 有趣的单品放入盒子，每月为你送上门。</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php if(!empty($box_list)): ?>
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
                <?php if (isset($box_list[1])) : ?>
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
                                <a href="/product?theme_id=<?=$box_list[1]['theme_id']?>&id=<?=$box_list[1]['id']?>" class="btn btn-primary"
                                   data-product="AmazingFun">Get AmazingFun</a>
                            </div>
                        </div>
                    </div>

                </div>
                <?php endif;?>
                <?php if (isset($box_list[2])) : ?>
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
                                <a href="/product?theme_id=<?=$box_list[2]['theme_id']?>&id=<?=$box_list[2]['id']?>" class="btn btn-primary"
                                   data-product="AmazingFunDX">Get AmazingFunDX</a>
                            </div>
                        </div>

                    </div>

                </div>
                <?php endif;?>
                <?php if (isset($box_list[3])) : ?>
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
                                <a href="/product?theme_id=<?=$box_list[3]['theme_id']?>&id=<?=$box_list[3]['id']?>" class="btn btn-primary"
                                   data-product="AmazingFunMIN">Get AmazingFunGirl</a>
                            </div>
                        </div>
                    </div>

                </div>
                <?php endif;?>
            </div>
        </div>

    </div>
    <?php endif;?>
    <section class="section section-youtubers">
      <header class="header-1">
        <div class="wrapper"><h2 class="hdr-2">视频拍摄</h2>
          <p>看看我们盒子的用户的视频反馈</p>
        </div>
      </header>
      <div class="swiper-container swiper-container-horizontal mt10 swiper-free">
        <div class="swiper-wrapper">
          <?php if (! empty($videosWall)): foreach ($videosWall as $videoWall):?>
          <div class="swiper-slide swiper-slide-duplicate " >
            <img src="<?=base_url('/resources/uploads/') . $videoWall['image']?>" alt="" class="btn-vedio " />
            <span class="swiper-vedio" data-vedio="<?=$videoWall['url']?>"></span>
          </div>
          <?php endforeach;endif;?>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    </section>
    <section class="section section-fan-wall">
      <div class="wrapper">
        <div class=" header-1">
          <div class="">
            <h2 class="hdr-2">展示墙</h2>
            <p class="desc">炫耀你的战利品在你的微博，朋友圈</p>
          </div>
        </div>
        <!--图片墙地址请安标签写-->
        <?php if (! empty($imagesWall)):?>
        <div id="isotope">
          <?php foreach ($imagesWall as $imageWall):?>
          <div class="element-item">
            <div class="element" style="background-image: url('<?=base_url('/resources/uploads/') . $imageWall['image']?>');"></div>
          </div>
          <?php endforeach;?>
        </div>
        <?php endif;?>
      </div>
    </section>
    <section class="section section-cta-module">
        <div class="wrapper"><h2 class="hdr-2">你还在等什么? 快加入我们！</h2>
            <a href="/product/all" class="btn btn-primary scroll-link"
               id="link-homepage-bottom-cta">Get Amazing</a>
        </div>
    </section>
    <div class="limited-box"></div>
    <!--视频播放窗口-->
    <div class="modal fade" id="vedio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content " >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                </div>

            </div>
        </div>
    </div>
</div>
<script src="/resources/assets/js/home/jquery.min.js"></script>
<script src="/resources/assets/js/home/isotope.pkgd.min.js"></script>
<script src="/resources/assets/js/home/swiper-3.4.0.jquery.min.js"></script>
<script src="/resources/assets/js/home/bootstrap.min.js"></script>
<script src="/resources/assets/js/home/main.js"></script>
<script>
$(function(){
       $('#isotope').isotope({
                // options
                itemSelector : '.element-item',
                layoutMode : 'fitRows'
            });
        var bannerSwiper = new Swiper('.bannerSwiper', {

                    autoplay: 4000,//可选选项，自动滑动
                    nextButton: '.swiper-button-next',
                    prevButton: '.swiper-button-prev'
                });
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
            var mySwiperfree = new Swiper('.swiper-free', {
            //
                        freeMode : true,
                        freeModeMomentumBounce : false,
                        freeModeSticky : true,
                        spaceBetween: 7,
                        width:230,
                        nextButton: '.swiper-button-next',
                        prevButton: '.swiper-button-prev'

                    });
})
// 视频弹窗
$('.swiper-vedio').click(function(){
    $('#vedio').modal('show');
    $('#vedio .modal-body').html($(this).attr('data-vedio'));

});
    $('#vedio').on('hide.bs.modal', function () {
          $('#vedio .modal-body iframe').remove();
    })
</script>
