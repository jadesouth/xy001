<div class="main-content">
  <div data-hook="account_summary" class="account-summary">
      <div class="container" style="margin-bottom:20px;">
        <h1 class="account-header"><img width="150" src="<?=base_url()?>resources/assets/images/WePayLogo.png" alt=""></h1>
        <div>
          <div style="line-height: 200%">订单编号：<span><?=$order_number?></span></div>
          <div style="line-height: 200%">订单名称：<span><?=$order_name?></span></div>
          <div style="line-height: 200%">订单金额：<span style="font-size:20px;">￥<?=$order_fee?></span></div>
        </div>
        <div style="margin:10px 0;">
          <img width="200" src="<?=base_url('Qrcodegenerate?data=' . $qrcode)?>" alt="支付二维码"><br />
          <img style="margin-top:10px;" width="200" src="<?=base_url()?>resources/assets/images/weixinpayqrinfo.png" alt="支付二维码">
        </div>
        <a class="btn btn-success" href="<?=base_url('member/order')?>" role="button">我已扫码支付成功</a>
      </div>
  </div>
</div>
<script src="/resources/assets/js/home/jquery.min.js"></script>
<script src="/resources/assets/js/home/bootstrap.min.js"></script>
<script src="/resources/assets/js/home/main.js"></script>