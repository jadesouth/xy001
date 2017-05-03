<?php

/**
 * Class Alipay
 */
class Alipay
{
    /**
     * createWebSubmit 创建WEB端提交支付宝支付
     *
     * @param int    $userID      创建订单者ID
     * @param string $orderNumber 订单编号
     * @param string $orderName   订单名称,一般为商品名称
     * @param float  $orderFee    订单费用
     * @param string $orderDesc   订单描述,一般为商品描述
     *
     * @return string 请求支付宝支付的表单html
     */
    public function createWebSubmit($userID, $orderNumber, $orderName, $orderFee, $orderDesc)
    {
        if (0 >= $userID || empty($orderNumber) || empty($orderName) || 0 >= $orderFee || empty($orderDesc)) {
            return false;
        }

        require_once PATH_LIBRARY . 'alipay' . DS . 'create_direct_pay_by_user' . DS . 'alipay.config.php';
        require_once PATH_LIBRARY . 'alipay' . DS . 'create_direct_pay_by_user' . DS . 'lib/alipay_submit.class.php';

        // 构造要请求的参数数组
        $parameter = [
            'service'            => $alipay_config['service'],                         // 接口名称
            'partner'            => $alipay_config['partner'],                         // 合作者身份ID
            'seller_id'          => $alipay_config['seller_id'],                       // 卖家支付宝用户号
            'payment_type'       => $alipay_config['payment_type'],                    // 支付类型,只支持取值为1（商品购买）。
            'notify_url'         => $alipay_config['notify_url'],                      // 服务器异步通知页面路径
            'return_url'         => $alipay_config['return_url'],                      // 页面跳转同步通知页面路径
            'anti_phishing_key'  => $alipay_config['anti_phishing_key'],               // 防钓鱼时间戳
            'exter_invoke_ip'    => $alipay_config['exter_invoke_ip'],                 // 客户端IP
            'out_trade_no'       => $orderNumber,                                      // 商户网站唯一订单号
            'subject'            => $orderName,                                        // 商品名称
            'total_fee'          => $orderFee,                                         // 交易金额
            'body'               => $orderDesc,                                        // 商品描述
            '_input_charset'     => trim(strtolower($alipay_config['input_charset'])), // 参数编码字符集
            'extra_common_param' => $userID                                            // 公用回传参数,此处为发起订单的用户ID
        ];

        // 建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter, "post", "确认");

        return $html_text;
    }

    /**
     * createWapSubmit 创建WAP端提交支付宝支付
     *
     * @param int $userID         创建订单者ID
     * @param string $orderNumber 订单编号
     * @param string $orderName   订单名称,一般为商品名称
     * @param float $orderFee     订单费用
     * @param string $orderDesc   订单描述,一般为商品描述
     *
     * @return string 请求支付宝支付的表单html
     */
    public function createWapSubmit($userID, $orderNumber, $orderName, $orderFee, $orderDesc)
    {
        if (0 >= $userID || empty($orderNumber) || empty($orderName) || 0 >= $orderFee || empty($orderDesc)) {
            return false;
        }

        require_once PATH_LIBRARY . 'alipay' . DS . 'alipay.wap' . DS . 'config.php';
        require_once PATH_LIBRARY . 'alipay' . DS . 'alipay.wap' . DS . 'wappay/service/AlipayTradeService.php';
        require_once PATH_LIBRARY . 'alipay' . DS . 'alipay.wap' . DS . 'wappay/buildermodel/AlipayTradeWapPayContentBuilder.php';
        $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
        $payRequestBuilder->setBody($orderDesc);
        $payRequestBuilder->setSubject($orderName);
        $payRequestBuilder->setOutTradeNo($orderNumber);
        $payRequestBuilder->setTotalAmount($orderFee);
        $payRequestBuilder->setTimeExpress('2m');
        $payResponse = new AlipayTradeService($config);
        $html_text = $payResponse->wapPay($payRequestBuilder, $config['return_url'], $config['notify_url']);
        return $html_text;
    }
}