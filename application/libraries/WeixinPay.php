<?php

/**
 * WeixinPay.php
 *
 * @author wangnan <wangnanphp@163.com>
 * @date   17-5-6 下午1:26
 */
class WeixinPay
{
    /**
     * createOrder 创建WEB端提交微信支付
     *
     * @param int    $userID      创建订单者ID
     * @param int    $productId   产品ID
     * @param string $orderNumber 订单编号
     * @param string $orderName   订单名称,一般为商品名称
     * @param float  $orderFee    订单费用
     * @throws \WxPayException
     *
     * @return array 返回结果数组
     */
    public function createOrder($userID, $productId, $orderNumber, $orderName, $orderFee)
    {
        include_once PATH_THIRD_PARTY . 'WxpayAPI_php_v3' . DS . 'lib' . DS . 'WxPay.Api.php';

        // 统一下单
        $unifiedOrder = new WxPayUnifiedOrder();
        $unifiedOrder->SetDevice_info('WEB');
        $unifiedOrder->SetBody($orderName);
        $unifiedOrder->SetAttach($userID);
        $unifiedOrder->SetOut_trade_no($orderNumber);
        // total fee 单位为"分",需要转换
        $orderFee = intval($orderFee * 100);
        $unifiedOrder->SetTotal_fee($orderFee);
        $unifiedOrder->SetTime_start(date("YmdHis"));
        $unifiedOrder->SetTime_expire(date("YmdHis", time() + 1200));
        $unifiedOrder->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
        $unifiedOrder->SetTrade_type("NATIVE");
        $unifiedOrder->SetProduct_id($productId);
        $orderCreateInfo = WxPayApi::unifiedOrder($unifiedOrder);

        return $orderCreateInfo;
    }
}