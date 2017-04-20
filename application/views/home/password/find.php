<div class="main-content" style="height: auto">
    <div class="container">
        <div class="text-center" style="margin: 100px 0">
            <p>忘记密码？请发送邮件</p>
            <div class="form-group">
                <input type="password" class="input-lg" placeholder="请输入新密码" required name="password" id="password"/>
            </div>
            <div class="form-group">
                <input type="password" class="input-lg" placeholder="确认您的新密码" required name="password_confirmation"
                       id="password_confirmation"/>
            </div>
            <div class="form-group">
                <input type="button" class="btn btn-danger" value="确定" id="find">
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

        $('#find').on('click', function () {
            var password = $('#password').val();
            var password_confirmation = $('#password_confirmation').val();
            $.ajax({
                type: "POST",
                url: "<?=$url?>",
                data: {"password": password, "password_confirmation": password_confirmation},
                dataType: "json",
                success: function (response) {
                    if (0 == response.status) {
                        layer.msg(response.msg, {icon: 6, time: 1000}, function () {
                            window.location.href = '/';
                        });
                        return;
                    } else if (1 == response.status) {
                        layer.alert(response.msg, {icon: 2});
                        return false;
                    }
                }
            });
        });
    });
</script>