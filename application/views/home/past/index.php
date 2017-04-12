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
                    <?php if(!empty($theme_and_year)):?>
                        <?php foreach ($theme_and_year as $theme_id=>$theme_data){?>
                            <li class="filter-group">
                                <button class="btn-filter selected" id="core-crate-filter-btn-<?=$theme_data['theme_id']?>" onclick="window.location.href='/past?theme_id=<?=$theme_data['theme_id']?>'"><b class="crate-name"><?=$theme_data['theme_name']?>
                                    </b> (<span class="crate-count"><?=$theme_data['count']?></span>)
                                </button>
                                <ul class="filter-sub-list">
                                    <?php foreach ($theme_data['year'] as $year){?>
                                    <a href="/past?theme_id=<?=$theme_data['theme_id']?>&year=<?=$year?>">
                                        <li class="filter-year">
                                            <button class="btn-filter selected" id="core-crate-<?=$year?>-filter-btn"><?=$year?></button>
                                        </li>
                                    </a>
                                    <?php }?>
                                </ul>
                            </li>
                        <?php }?>
                    <?php endif;?>
                </ul>
                <header class="header-2 hide">Filter by Brand</header>
                <ul class="filter-list brand-list hide"></ul>
                <div class="view-more-container hide">
                    <button class="btn-link" id="view-more-brands-btn">View more</button>
                </div>
            </aside>
            <ul class="crates past-slides tabs">
                <?php if(!empty($box_list)):?>
                <?php foreach ($box_list as $key=>$box_data){?>
                    <li class="tab filtered" data-product="core-crate" data-name="Loot Crate" data-month="<?=$box_data['month']?>"
                        data-year="<?=$box_data['year']?>" data-brands=""
                        style="background-image: url('<?=$box_data['cover_image']?>');">
                        <button id="core-crate-<?=$box_data['month']?>-<?=$box_data['year']?>-tab" class="btn-reset btn-tab" data-id="<?=$box_data['id']?>"><h6 class="hdr-6"><span><?=$box_data['cover_title']?></span><span></span>
                            </h6> <h4 class="hdr-3"><span class="product"><?=$box_data['theme_name']?></span><span
                                        class="date"></span></h4> <h6 class="hdr-6">
                                <span><?=$box_data['cover_subtitle']?></span><span></span>
                            </h6></button>
                    </li>
                <?php }?>
                <?php endif;?>
                <article class="slide swiper-slide" style="background-image: url(https://images.contentful.com/rzwi86gxgpgo/60CbBFw51u2cAkimUqCC2u/31a8c4bbf3bfad9137fb0c67b3153bb3/past-core-invasion-items.jpg);" id="introduction">
                    <div class="slide-container "><h4 class="hdr">本月介绍</h4>
                        <p class="desc" id="introduction_title">我们把最流行，最炫酷的动漫手办，游戏装备放进您的盒子中，包括海贼王、魔兽世界等更多！</p>
                        <p><a href="/product?theme_id=AmazingFun&id=188" class="btn btn-primary purchase-link" id="btn_buy">购买</a></p>
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
            var id = $(this).data('id');
            var ajax_return = false;
            $.ajax({
                type: "POST",
                url: "<?=base_url("/past/ajaxGetBoxIntroduction")?>",
                data: {"id": id},
                dataType: "json",
                success: function(response){
                    if(0 == response.status) {
                        var bg_image_url = "https://images.contentful.com/rzwi86gxgpgo/60CbBFw51u2cAkimUqCC2u/31a8c4bbf3bfad9137fb0c67b3153bb3/past-core-invasion-items.jpg";
                        bg_image_url = response.data.introduction_image ? response.data.introduction_image : bg_image_url;
                        $('#introduction').css("background-image","url("+bg_image_url+")");
                        $('#introduction_title').html(response.data.introduction_title);
                        $('#btn_buy').attr('href',"/product?theme_id="+response.data.theme_id+"&id="+response.data.id);
                    }
                }
            });
            $(this).toggleClass('active').toggleClass('');
            $(this).parent().siblings('.tab').find('.btn-tab').removeClass('active');
            if($(this).hasClass('active')){
                $('#introduction').show();
            }else{
                $('#introduction').hide();
            }
        });
        $('#toggle-filter-btn').click(function(){
            $('.filters').toggleClass('active').toggleClass('');
        })

    })

</script>