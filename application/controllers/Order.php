<?php

/**
 * Class Order
 *
 * @property Order_model $_model
 */
class Order extends Home_Controller
{
    /**
     * upgradePay
     */
    public function upgradePay()
    {
        $this->checkLogin();
        $userId = $this->_loginUser['id'];
        if ('post' == $this->input->method()) {
            $postName = $this->input->post('post_name', true);
            $postPhone = $this->input->post('post_phone', true);
            $postAddr = $this->input->post('post_addr', true);
            $orderId = $this->input->post('order', true);

            // 获取订单信息
            $this->load->model('order_model');
            $fields = 'id,order_number,user_id,box_id,box_name,order_value,pay_value,plan_number';
            $order = $this->order_model
                ->setSelectFields($fields)
                ->setAndCond(['id' => $orderId, 'user_id' => $userId, 'status' => 2])
                ->get();
            if (empty($order) || 12 == $order['plan_number']) {
                show_404();
            }
            // 获取盒子信息
            $this->load->model('box_model');
            $box = $this->box_model
                ->setSelectFields('id,monthly_price,annually_price')
                ->find($order['box_id']);
            if (empty($box)) {
                show_404();
            }

            // 计算出需要支付的价格
            $fee = $box['annually_price'] - $order['order_value'];
            if (0 >= $fee) {
                show_404();
            }

            // 记录升级套餐信息
            $update = [
                'upgrade_before_order_value' => $order['order_value'],
                'upgrade_order_value'        => $fee,
                'upgrade_before_pay_value'   => $order['pay_value'],
                'upgrade_pay_value'          => $fee,
                'upgrade_before_plan_number' => $order['plan_number'],
                'upgrade_plan_number'        => 12 - $order['plan_number'],
                'upgrade_post_name'          => $postName,
                'upgrade_post_phone'         => $postPhone,
                'upgrade_post_addr'          => $postAddr,
                'upgrade_status'             => 0, // 升级未完成
                'upgrade_pay_status'         => 0, // 未支付
            ];
            $res = $this->order_model
                ->setUpdateData($update)
                ->setAndCond(['id' => $orderId, 'user_id' => $userId, 'status' => 2])
                ->update();
            if (! $res) {
                show_404();
            }

            $fee = 0.01; // TODO del.
            // 构造请求支付宝支付参数
            $orderNumber = substr($order['order_number'], 0, 18) . '1';
            $orderName = '升级计划'; // 订单名称
            $orderDesc = '升级计划'; // 商品描述
            $orderFee = $fee;
            $this->load->library('Alipay');
            $htmlText = $this->alipay->createWebSubmit($userId, $orderNumber, $orderName, $orderFee, $orderDesc);
            echo $htmlText;
        } else {
            show_404();
        }
    }

    /**
     * upgradePaymentZfbReturn 升级计划支付宝支付完成后,支付宝支付完成同步回调结果数据处理
     */
    public function upgradePaymentZfbReturn()
    {
        $callbackData = $this->input->get();
        if (empty($callbackData)) {
            show_error('支付宝处理支付延迟，支付结果大概5分钟到，请您稍后在个人订单中心查看订单升级详情。');
        }

        $user_id = isset($callbackData['extra_common_param']) ? $callbackData['extra_common_param'] : 0;
        $order_number = isset($callbackData['out_trade_no']) ? $callbackData['out_trade_no'] : 0;
        if (0 >= $user_id || empty($order_number)) {
            show_error('支付宝处理支付延迟，支付结果大概5分钟到，请您稍后在个人订单中心查看订单升级详情。');
        }

        // 记录支付完成
        $res = $this->_model->upgradePaymentCompleted($user_id, $order_number, $callbackData);
        if ($res) {
            if ('TRADE_FINISHED' != strtoupper($callbackData['trade_status']) && 'TRADE_SUCCESS' != strtoupper($callbackData['trade_status'])) {
                show_error('支付宝支付失败,请重试！');
            } else {
                redirect('member/order');
            }
        } else {
            if ('TRADE_FINISHED' != strtoupper($callbackData['trade_status']) && 'TRADE_SUCCESS' != strtoupper($callbackData['trade_status'])) {
                show_error('支付宝支付失败,请重试！');
            } else {
                show_error('第三方处理支付延迟，支付结果大概5分钟到，请您稍后在个人订单中心查看订单升级详情。');
            }
        }
    }

    /**
     * productPaymentZfbReturn 购买盒子支付宝支付完成后,支付宝支付完成同步回调结果数据处理
     */
    public function productPaymentZfbReturn()
    {
        $callbackData = $this->input->get();
        if (empty($callbackData)) {
            show_error('支付宝处理支付延迟，支付结果大概5分钟到，请您稍后在个人订单中心查看订单升级详情。');
        }

        $order_number = isset($callbackData['out_trade_no']) ? $callbackData['out_trade_no'] : 0;
        if (empty($order_number)) {
            show_error('支付宝处理支付延迟，支付结果大概5分钟到，请您稍后在个人订单中心查看订单升级详情。');
        }

        // 记录支付完成
        $user_id = $this->_loginUser['id'];
        $res = $this->_model->productPaymentCompleted($user_id, $order_number, $callbackData);
        if (!$res) {
            redirect('member/order');
        } else {
            show_error('第三方处理支付延迟，支付结果大概5分钟到，请您稍后在个人订单中心查看订单升级详情。');
        }
    }

    /**
     * upgradePaymentZfbNotify 升级计划支付宝支付完成后,支付宝支付完成异步回调结果数据处理
     */
    public function upgradePaymentZfbNotify()
    {
        $callbackData = $this->input->post();
        if (empty($callbackData)) {
            echo 'fail';

            return;
        }

        $user_id = isset($callbackData['extra_common_param']) ? $callbackData['extra_common_param'] : 0;
        $order_number = isset($callbackData['out_trade_no']) ? $callbackData['out_trade_no'] : 0;
        if (0 >= $user_id || empty($order_number)) {
            echo 'fail';

            return;
        }

        // 记录支付完成
        $res = $this->_model->upgradePaymentSuccess($user_id, $order_number, $callbackData);
        if ($res) {
            echo 'fail';
        } else {
            echo 'success';
        }
    }
}
