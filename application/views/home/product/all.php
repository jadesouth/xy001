<style>
    @media (min-width: 768px){
        .all-crates  .section-header {
            background-image: url("/resources/assets/images/pastbanner.png");
        }
        /*.all-crates .section-listing .product-item.core-crate .img-container {*/
        /*background-image: url("//images.contentful.com/rzwi86gxgpgo/1A4CJMfj2UeS0cISwAc4gw/00ad7154acb8aaf3b7c5dc8bcbbe082d/all-crates-lootcrate.jpg");*/
        /*}*/
    }
    @media (max-width:768px){
        .all-crates .section-header .hero-mobile {
            display: block;
            max-width: 100%;
        }
        .all-crates .section-header .copy {
            max-width: 90%;
            text-align: center;
            margin: 0 auto;
            color:#333;
        }

    }
    .all-crates .section-listing .product-item .info-container .price{
        font-size: 24px;
    }


    /*@media (max-width: 767px) {*/
    /*.section-listing .product-item.anime-crate .img-container {*/
    /*background-image: url("//images.contentful.com/rzwi86gxgpgo/4LVCPRwXXiOKoeO24msSGU/d4638b9689a4e8cdd59acda0c42e0f67/all-crates-anime-bkgd-mobile.jpg");*/
    /*}*/
    /*}*/
</style>
<div class="main-content">
    <div class="section section-header">
        <div class="wrapper">
            <img src="/resources/assets/images/pastbanner.png" alt="banner" class="hero-mobile"/>
            <div class="copy">
                <h1 class="hdr-1">选择你的盒子</h1>

                <p class="desc">AmazingFun是极客装备，玩家装备和流行文化的用品。我们提供一流的（往往是独家！）如收藏品、T恤、家居用品，每月直接送上门</p>
            </div>
        </div>
    </div>

    <section class="section section-listing">
        <div class="wrapper">
            <ul class="header-1">
                <li class="filter-item<?=('all'== $tag_type) ? ' active': '';?>">
                    <a href="/product/all"><button  class="btn-link" id="btn-filter-all" >所有盒子</button></a>
                </li>
                <?php if(!empty($tag_list)){?><?php foreach ($tag_list as $tag){?>
                <li class="filter-item<?=($tag == urldecode($tag_type)) ? ' active': '';?>">
                    <a href="/product/all/<?=$tag?>"><button  class="btn-link" id="btn-filter-limited"><?=$tag?></button></a>
                </li>
                <?php }}?>
            </ul>
        </div>
        <ul class="wrapper product-list">
            <?php if(!empty($box_list)){?><?php foreach ($box_list as $box_info){?>
            <li class="product-item monthly core-crate active">
                <a href="/product?theme_id=<?=$box_info['theme_id']?>&id=<?=$box_info['id']?>" class="img-container" id="link-core-crate-img">
                    <img src="<?=$box_info['cover_image']?>" alt="crate.logo.description" class="img-logo">
                </a>

                <div class="desc-container">
                    <p class="desc"><?=$box_info['introduction_title']?></p>
                    <h6 class="hdr-6">
                        <span class="text">特许经营权</span>
                    </h6>
                    <!--<img src="//images.contentful.com/rzwi86gxgpgo/3uaBt3XC9isoG8SUc2wgWG/d864e799e3962874c73c6329be8c3fba/LC-origins-Web_theme-module-franchise-logos.png"-->
                    <!--alt="crate.franchises.description" class="img-franchises">-->
                </div>
                <div class="info-container" data-sku="core-crate" data-type="monthly">
                    <div class="pricing">
                        <h3 class="price">
                            <span class="currency-symbol">¥</span>
                            <span class="hdr-1 amount"><?=$box_info['monthly_price']?></span>
                            <span class="per-wrapper">
                                <!--<span class="hdr-3 currency">CAD</span>-->
                                <span class="per-month">/ 月</span>
                            </span>
                        </h3>
                        <p class="sub-text sh-text" style="display: block;">
                            <span class="plus-sh" style="display: none;">加上运费</span>
                            <span class="inc-sh">包含运费</span>
                        </p>
                    </div>
                    <a href="/product?theme_id=<?=$box_info['theme_id']?>&id=<?=$box_info['id']?>" class="btn btn-primary" id="link-core-crate-cta">获取<?=$box_info['theme_name']?></a>
                </div>
            </li>
            <?php }}?>


        </ul>
    </section>
</div>
<script src="/resources/assets/js/home/jquery.min.js"></script>
<script src="/resources/assets/js/home/swiper-3.4.0.jquery.min.js"></script>
<script src="/resources/assets/js/home/bootstrap.min.js"></script>
<script src="/resources/assets/js/home/main.js"></script>

<script>
    $(function(){
        $('.filter-item').click(function(){
            $(this).addClass('active');
            $(this).siblings('.filter-item').removeClass('active');
        })
    })
</script>