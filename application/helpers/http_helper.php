<?php

/**
 * HTTP 相关辅助函数
 */
if ( ! function_exists('http_ajax_response'))
{
    /**
     * http_ajax_response   Http ajax请求的响应
     *
     * @param int $status_code 响应码 [0:OK,其他:Error]
     * @param string $msg 响应的消息,一般用于失败时的错误消息
     * @param array $data 相关数据
     */
    function http_ajax_response($status_code = 0, $msg = '', $data = [])
    {
        http_json_response(['status' => (int)$status_code, 'msg' => (string)$msg, 'data' => $data]);
    }
}

if ( ! function_exists('http_json_response'))
{
    /**
     * http_json_response http json 响应
     * 并未直接输出到前端,脚本执行结束时将自动输出响应
     *
     * @param array $data JSON响应的数组
     */
    function http_json_response(array $data)
    {
        get_instance()->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data, JSON_UNESCAPED_UNICODE));
    }
}

if (! function_exists('layer_success_response')) {
    /**
     * layer_success_response layer成功响应
     *
     * @param string $message
     * @param int $time
     */
    function layer_success_response($message, $time = 2000)
    {
        $message = trim(strip_tags(str_replace(PHP_EOL, '', $message)));
        echo <<<SCRIPT
<script src="/resources/assets/js/home/jquery.min.js"></script>
<script src="/resources/assets/libs/layui/layui.js"></script>
<script>
// 加载layer
layui.use('layer', function () {
var layer = layui.layer;
layer.msg('{$message}', {icon: 6, time:{$time}}, function () {
history.go(-1);
})
});
</script>
SCRIPT;
        exit;
    }
}

if (! function_exists('layer_fail_response')) {
    /**
     * layer_fail_response layer失败响应
     *
     * @param string $message
     * @param int $time
     */
    function layer_fail_response($message, $time = 2000)
    {
        $message = trim(strip_tags(str_replace(PHP_EOL, '', $message)));
        echo $message;
        echo <<<SCRIPT
<script src="/resources/assets/js/home/jquery.min.js"></script>
<script src="/resources/assets/libs/layui/layui.js"></script>
<script>
// 加载layer
layui.use('layer', function () {
var layer = layui.layer;
layer.msg('{$message}', {icon: 2, time:{$time}}, function () {
history.go(-1);
})
});
</script>
SCRIPT;
        exit;
    }
}