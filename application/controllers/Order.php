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
            $orderId = $this->input->post('order', true);
            $postName = $this->input->post('post_name', true);
            $postPhone = $this->input->post('post_phone', true);
            $postAddr = $this->input->post('post_addr', true);
            $payMethod = $this->input->post('pay_method', true);
            if (! in_array($payMethod, ['zfb', 'wx'])) {
                show_error('支付方式错误', 500, '支付错误');
            }

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
            if ('zfb' == $payMethod) {
                $this->load->library('Alipay');
                if (is_mobile()) {
                    $htmlText = $this->alipay->createWapSubmit($userId, $orderNumber, $orderName, $orderFee, $orderDesc);
                } else {
                    $htmlText = $this->alipay->createWebSubmit($userId, $orderNumber, $orderName, $orderFee, $orderDesc);
                }
                echo $htmlText;
            } elseif ('wx' == $payMethod) {
                try {
                    $this->load->library('WeixinPay');
                    $notifyUrl = base_url('Order/upgradePaymentWXNotify');
                    $orderCreateInfo = $this->weixinpay->createOrder($userId, $order['box_id'], $orderNumber, $orderName, $orderFee, $notifyUrl);
                    if ('SUCCESS' == $orderCreateInfo['return_code'] && 'SUCCESS' == $orderCreateInfo['result_code'] && ! empty($orderCreateInfo['code_url'])) {
                        $this->_viewVar['order_number'] = $order['order_number'];
                        $this->_viewVar['order_name'] = '升级计划';
                        $this->_viewVar['order_fee'] = $orderFee;
                        $this->_viewVar['qrcode'] = urlencode($orderCreateInfo['code_url']);
                        $this->load_view('order/wx');
                    } else {
                        show_error('微信支付错误', 500, '支付错误');
                    }
                } catch (Exception $e) {
                    show_error($e->getMessage(), 500, '支付错误');
                }
            } else {
                show_error('支付方式错误', 500, '支付错误');
            }
        } else {
            show_404();
        }
    }

    /**
     * upgradePaymentWXNotify 升级计划,微信支付,支付成功回调处理订单
     */
    public function upgradePaymentWXNotify()
    {
        $this->load->library('WeixinPay');
        $this->weixinpay->notify([$this, 'upgradePaymentWXNotifyProcess']);
    }

    public function upgradePaymentWXNotifyProcess($callbackData)
    {
        // 记录支付完成
        return $this->_model->upgradePaymentWxSuccess($callbackData);
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

        $user_id = isset($callbackData['extra_common_param']) ? $callbackData['extra_common_param'] : 0;
        $order_number = isset($callbackData['out_trade_no']) ? $callbackData['out_trade_no'] : 0;
        if (0 >= $user_id || empty($order_number)) {
            show_error('支付宝处理支付延迟，支付结果大概5分钟到，请您稍后在个人订单中心查看订单升级详情。');
        }

        $res = $this->_model->productPaymentZfbCompleted($user_id,$order_number, $callbackData);
        if ($res) {
            if (isset($callbackData['trade_status']) && 'TRADE_FINISHED' != strtoupper($callbackData['trade_status']) && 'TRADE_SUCCESS' != strtoupper($callbackData['trade_status'])) {
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
        $res = $this->_model->upgradePaymentZfbSuccess($user_id, $order_number, $callbackData);
        if ($res) {
            echo 'fail';
        } else {
            echo 'success';
        }
    }

    /**
     * productPaymentZfbNotify 购买盒子支付宝支付完成后,支付宝支付完成异步回调结果数据处理
     */
    public function productPaymentZfbNotify()
    {
        $callbackData = $this->input->post();
        log_message('error',json_encode($callbackData));
        if (empty($callbackData)) {
            log_message('error','');
            echo 'fail';
            return;
        }

        $user_id = isset($callbackData['extra_common_param']) ? $callbackData['extra_common_param'] : 0;
        $order_number = isset($callbackData['out_trade_no']) ? $callbackData['out_trade_no'] : 0;
        if (0 >= $user_id || empty($order_number)) {
            log_message('error','');
            echo 'fail';
            return;
        }

        // 记录支付完成
        $res = $this->_model->productPaymentZfbSuccess($user_id, $order_number, $callbackData);
        if (!$res) {
            log_message('error','');
            echo 'fail';
        } else {
            log_message('info','');
            echo 'success';
        }
    }

    /**
     * productPaymentWXNotify 购买盒子支付宝支付完成后,微信支付完成异步回调结果数据处理
     */
    public function productPaymentWXNotify()
    {
        $this->load->library('WeixinPay');
        $this->weixinpay->notify([$this, 'productPaymentWXNotifyProcess']);
    }

    public function productPaymentWXNotifyProcess($callbackData)
    {
        // 记录支付完成
        return $this->_model->productPaymentWxSuccess($callbackData);
    }
}
