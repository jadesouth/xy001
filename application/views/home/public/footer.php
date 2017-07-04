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
<div class="qqserver">
    <div class="qqserver_fold">
        <div></div>
    </div>
    <div class="qqserver-body" style="display: block;">
        <div class="qqserver-header">
            <div></div>
            <span class="qqserver_arrow"></span> </div>
        <ul>
            <li> <a title="点击这里给我发消息" href="http://wpa.qq.com/msgrd?v=3&amp;uin=772100892&amp;site=qq&amp;menu=yes" target="_blank">
                <div>客服咨询</div>
                <span>琳琳</span> </a> </li>
        
        </ul>
    </div>
</div>
<script src="/resources/assets/libs/qq-chat/js/zzsc.js" type="text/javascript"></script>
</body>
</html>