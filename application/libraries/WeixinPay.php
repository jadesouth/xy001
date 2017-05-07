<?php

/**
 * Class WeixinPay
 */
class WeixinPay extends WxPayNotify
{
    /**
     * @var string 回调函数
     */
    private $callback = '';

    /**
     * WeixinPay constructor.
     */
    public function __construct()
    {
        include_once PATH_THIRD_PARTY . 'WxpayAPI_php_v3' . DS . 'lib' . DS . 'WxPay.Api.php';
    }

    /**
     * createOrder 创建WEB端提交微信支付
     *
     * @param int    $userID      创建订单者ID
     * @param int    $productId   产品ID
     * @param string $orderNumber 订单编号
     * @param string $orderName   订单名称,一般为商品名称
     * @param float  $orderFee    订单费用
     * @param string $notifyUrl   回调的URL
     *
     * @return array 返回结果数组
     */
    public function createOrder($userID, $productId, $orderNumber, $orderName, $orderFee, $notifyUrl)
    {
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
        $unifiedOrder->SetNotify_url($notifyUrl);
        $unifiedOrder->SetTrade_type("NATIVE");
        $unifiedOrder->SetProduct_id($productId);
        $orderCreateInfo = WxPayApi::unifiedOrder($unifiedOrder);

        return $orderCreateInfo;
    }

    /**
     * queryOrder 查询订单
     *
     * @param $transaction_id
     *
     * @return bool
     */
    private function queryOrder($transaction_id)
    {
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = WxPayApi::orderQuery($input);
        if (array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS"
        ) {
            return true;
        }

        return false;
    }

    public function notify($callback)
    {
        $this->setCallback($callback);
        $this->Handle(false);
    }

    /**
     * notifyProcess 重写回调处理函数
     *
     * @param array  $data
     * @param string $msg
     *
     * @return bool
     */
    public function notifyProcess($data, &$msg)
    {
        if (! array_key_exists("transaction_id", $data)) {
            $msg = "输入参数不正确";

            return false;
        }
        //查询订单，判断订单真实性
        if (! $this->Queryorder($data["transaction_id"])) {
            $msg = "订单查询失败";

            return false;
        }

        $res = call_user_func($this->callback, $data);
        if ($res['status'] !== 0) {
            $msg = $res['msg'];

            return false;
        }

        return true;
    }

    /**
     * setCallback
     *
     * @param $callback
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
    }
}