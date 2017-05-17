<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AmazingFun</title>
    <link href="/resources/assets/images/favicon.ico" rel="icon" type="image/x-icon"/>
    <link rel="stylesheet" href="/resources/assets/css/home/bootstrap.min.css"/>
    <link rel="stylesheet" href="/resources/assets/css/home/swiper-3.4.0.min.css"/>
    <link rel="stylesheet" href="/resources/assets/css/home/normalize.css"/>
    <link rel="stylesheet" href="/resources/assets/css/home/main.css"/>
</head>
<body  id="pwreset-steps">
<div class="main-content">

    <div class="container">

        <div class="text-center repwd" style="margin: 100px 0">
            <p>恭喜您加入AmazingFun！通过当前途径注册您将收到我们为您准备的优惠券</p>
            <form action="" >
                <input type="text" class="input-lg" id="email" name="email" placeholder="邮箱：" required/>
                <input type="password" class="input-lg" id="password" name="password" placeholder="密码：" required/>
                <button type="button" class="btn btn-resetpwd">注册</button>
            </form>
        </div>

    </div>
</div>
<script src="/resources/assets/js/home/jquery.min.js"></script>
<script src="/resources/assets/js/home/swiper-3.4.0.jquery.min.js"></script>
<script src="/resources/assets/js/home/bootstrap.min.js"></script>
<script src="/resources/assets/js/home/main.js"></script>
<script src="/resources/assets/libs/layui/layui.js" type="application/javascript"></script>
</body>
<script>
    layui.use('layer', function () {
        var layer = layui.layer;
    });
    $('.btn-resetpwd ').on('click', function () {
        var user = $('#email').val();
        var pwd = $('#password').val();
        $.ajax({
            type: "POST",
            url: "/user/register",
            data: {"email": user,"password": pwd},
            dataType: "json",
            success: function(response){
                if (0 == response.status) {
                    layer.msg(response.msg, {icon: 6, time:1000}, function () {
                        window.location.reload();
                    });
                } else if (1 == response.status) {
                    layer.alert(response.msg, {icon: 2});
                    return false;
                }
            }
        });
    });
</script>
</html>