<div id="footer-min">
    <div class="container">
        <div class="pull-left"><p>Copyright © 北京阿妹子文化传播有限公司 amazingfun.cn 版权所有</p></div>
    </div>
</div>
<script src="/resources/assets/libs/layui/layui.js" type="application/javascript"></script>
<script>
    // 加载layer
    layui.use('layer', function () {
        var layer = layui.layer;
    });
    $(function () {
        $('#userregister ').on('click', function () {
            var user = $('#recipient-user').val();
            var pwd = $('#recipient-pwd').val();
            $.ajax({
                type: "POST",
                url: "/user/ajax_register",
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
        $('#loginuser').on('click', function () {
            var user = $('#recipient-user').val();
            var pwd = $('#recipient-pwd').val();
            $.ajax({
                type: "POST",
                url: "/user/ajax_login",
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
//        $('#logout,#loginout').on('click', function () {
//            $.ajax({
//                type: "POST",
//                url: "/user/ajax_register",
//                data: {"email": user,"password": pwd},
//                dataType: "json",
//                success: function(response){
//                    if (0 == response.status) {
//                        layer.msg(response.msg, {icon: 6, time:1000}, function () {
//                            window.location.reload();
//                        });
//                    } else if (1 == response.status) {
//                        layer.alert(response.msg, {icon: 2});
//                        return false;
//                    }
//                }
//            });
//            $('#header-my-account-link').addClass('hidden');
//            $('#dropdown-account').attr('aria-expanded', false);
//            $('#dropdown-account').removeClass('in');
//            $('#header-log-in-modal-link').removeClass('hidden').show();
//            $("#loginaccount").addClass('hidden');
//            $('.loginbtn').removeClass('hidden');
//        })
    })
</script>
</body>
</html>