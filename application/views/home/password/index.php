<style>
    .checkout-indicator {
        display: inline-block;
        float: left;
        margin: 30px 0 0 30px;
    }

    @media (min-width: 768px) {
        .all-crates .section-header {
            background-image: url("//images.contentful.com/rzwi86gxgpgo/4aCbftWO8oqiMiCsGK6eY8/7a3eb41c31a017b19659c7d07575dd6c/all-crates-hero.jpg");
        }

        .all-crates .section-listing .product-item.core-crate .img-container {
            background-image: url("//images.contentful.com/rzwi86gxgpgo/1A4CJMfj2UeS0cISwAc4gw/00ad7154acb8aaf3b7c5dc8bcbbe082d/all-crates-lootcrate.jpg");
        }
    }

    @media (max-width: 768px) {
        .all-crates .section-header .hero-mobile {
            display: block;
            max-width: 100%;
        }

        .all-crates .section-header .copy {
            max-width: 90%;
            text-align: center;
            margin: 0 auto;
            color: #333;
        }
    }

</style>
<div class="main-content" style="height: auto">

    <div class="container">
        <div class="text-center" style="margin: 100px 0">
            <p>忘记密码？请发送邮件</p>
            <input type="email" class="input-lg" placeholder="Email" required/>
            <button type="button" class="btn btn-danger">发送</button>
        </div>

    </div>
</div>
<script src="/resources/assets/js/home/jquery.min.js"></script>
<script src="/resources/assets/js/home/swiper-3.4.0.jquery.min.js"></script>
<script src="/resources/assets/js/home/bootstrap.min.js"></script>
<script src="/resources/assets/js/home/main.js"></script>
<script>
    $(function () {

        $('#checkout-continue-link').click(function(){
            $('.checkout-login-box').hide();
            $('#accordion').removeClass('hide');
        })
    })


</script>