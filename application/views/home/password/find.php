<style>
    .checkout-indicator {
        display: inline-block;
        float: left;
        margin: 30px 0 0 30px;
    }
</style>
<div class="main-content">

    <div class="container">
        <div class="text-center repwd" style="margin: 100px 0">
            <input type="password" class="input-lg" placeholder="新密码" required name="password" id="password"/>
            <input type="password" class="input-lg" placeholder="确认新密码" required name="password_confirmation"
                   id="password_confirmation"/>
            <button type="button" class="btn btn-reset" title="" id="find">确定</button>
        </div>

    </div>
</div>
<div class="modal fade" id="foremail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h5 style="padding:30px 0;">密码重置成功 <span></span></h5>
            </div>

        </div>
    </div>
</div>
<script src="/resources/assets/js/home/jquery.min.js"></script>
<script src="/resources/assets/js/home/swiper-3.4.0.jquery.min.js"></script>
<script src="/resources/assets/js/home/bootstrap.min.js"></script>
<script src="/resources/assets/js/home/main.js"></script>
<script src="/resources/assets/libs/layui/layui.js" type="application/javascript"></script>
<script>
    $(function () {
        // 加载layer
        layui.use('layer', function () {
            var layer = layui.layer;
        });

        $('.btn-reset').on('click', function () {
            var password = $('#password').val();
            var password_confirmation = $('#password_confirmation').val();
            $.ajax({
                type: "POST",
                url: "<?=$url?>",
                data: {"password": password, "password_confirmation": password_confirmation},
                dataType: "json",
                success: function (response) {
                    if (0 == response.status) {
                        $("#foremail").modal("show");//  弹窗显示
                        setTimeout(function () {
                            $("#foremail").modal("hide");
                            window.location.href = '/';
                        }, 3000);//3秒后自动关闭

                        return;
                    } else if (1 == response.status) {
                        layer.alert(response.msg, {icon: 2});
                        return false;
                    }
                }
            });
        });
    })
</script>
</body>
</html>