<?php

/**
 * Class Order
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
            $fields = 'id,order_number,user_id,box_id,box_name,order_value,plan_number';
            $order = $this->order_model
                ->setSelectFields($fields)
                ->setAndCond(['order_number' => $orderId, 'user_id' => $userId, 'status' => 1])
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

            // 将地址信息先暂时写入SESSION
            $_SESSION['order_upgrade'][$orderId] = [
                'post_name'  => $postName,
                'post_phone' => $postPhone,
                'post_addr'  => $postAddr,
            ];

            // 计算出需要支付的价格
            $fee = $box['annually_price'] - $order['order_value'];
            if (0 >= $fee) {
                show_404();
            }

            var_dump($fee);die;

            // 构造请求支付宝支付参数
            $orderName = '升级计划'; // 订单名称
            $orderDesc = '升级计划'; // 商品描述
            $orderFee = $fee;
            $htmlText = $this->createAlipaySubmit($userId, $order['order_number'], $orderName, $orderFee, $orderDesc);

            echo $htmlText;
        } else {
            show_404();
        }
    }

    /**
     * upgradePaymentCompleted 升级支付完成,创建支付宝支付完成同步回调结果数据并将支付订单状态改为已支付
     */
    public function upgradePaymentCompleted()
    {
        $callbackData = $this->input->get();
        if (empty($callbackData)) {
            show_error('支付宝支付延迟，支付结果大概5分钟到,请您稍后在个人订单中心查看订单升级详情。');
        }

        $insertData = [
            'user_id'      => isset($callbackData['extra_common_param']) ? $callbackData['extra_common_param'] : 0,
            'order_number' => isset($callbackData['out_trade_no']) ? $callbackData['out_trade_no'] : 0,
            'pay_type'     => 0, // 支付类型[0:支付宝电脑网站支付,1:支付宝手机网站支付]
            'http_method'  => 'GET',
            'content'      => json_encode($callbackData, JSON_UNESCAPED_UNICODE),
        ];

        // 存储callback data
        $this->load->model('pay_callback_result_model');
        $this->pay_callback_result_model
            ->setInsertData($insertData)
            ->create();
    }

    /**
     * prepaid_deposit_complete 创建支付宝支付完成同步回调结果数据并将支付订单状态改为已支付
     */
    public function prepaid_deposit_complete()
    {
        $zfb_callback_result_data = $this->get_zfb_callback_result_data('get');
        // 记录日志信息
        $this->load->helper('logs');
        if (empty($zfb_callback_result_data)) {
            // 记录错误日志
            seaslog_error("Log_Id: {$this->log_id}, " . 'Error: 支付宝 return_url $zfb_callback_result_data为空',
                'prepaid_deposit_callback');
            $this->load_view('public/error_info', ['error_msg' => '支付宝支付延迟，充值资金大概5分钟后到账,请您稍后在个人中心查看押金余额。']);
            return;
        }

        // 日志信息
        $log_msg['post'] = $this->input->get();
        $log_msg['zfb_callback_result_data'] = $zfb_callback_result_data;
        // 创建支付宝支付完成同步回调结果数据并将支付订单状态改为已支付
        $this->load->model('zfb_callback_result_model');
        $create_res = $this->zfb_callback_result_model->create_zfb_return_info($zfb_callback_result_data);
        if (false === $create_res) {
            // 记录错误日志
            seaslog_error("Log_Id: {$this->log_id}, " . 'Error: 支付宝 return_url 回调失败,create_zfb_return_info执行失败,参数信息: ' . json_encode($log_msg,
                    JSON_UNESCAPED_UNICODE), 'prepaid_deposit_callback');
            $this->load_view('public/error_info', ['error_msg' => '支付宝支付延迟，充值资金大概5分钟后到账,请您稍后在个人中心查看押金余额。']);
            return;
        }

        seaslog_error("Log_Id: {$this->log_id}, " . 'Success: 支付宝 return_url 回调成功,参数信息: ' . json_encode($log_msg,
                JSON_UNESCAPED_UNICODE), 'prepaid_deposit_callback');
        $this->load_view('public/success_info', ['success_msg' => '支付宝支付成功，充值资金大概5分钟后到您的押金,请您稍后在个人中心查看押金余额。']);
    }

    /**
     * createAlipaySubmit 创建提交支付宝支付
     *
     * @param int    $userID      创建订单者ID
     * @param string $orderNumber 订单编号
     * @param string $orderName   订单名称,一般为商品名称
     * @param float  $orderFee    订单费用
     * @param string $orderDesc   订单描述,一般为商品描述
     * @return string 请求支付宝支付的表单html
     */
    private function createAlipaySubmit($userID, $orderNumber, $orderName, $orderFee, $orderDesc)
    {
        if (0 >= $userID || empty($orderNumber) || empty($orderName) || 0 >= $orderFee || empty($orderDesc)) {
            return false;
        }

        require_once PATH_LIBRARY . 'alipay' . DS . 'create_direct_pay_by_user' . DS . 'alipay.config.php';
        require_once PATH_LIBRARY . 'alipay' . DS . 'create_direct_pay_by_user' . DS . 'lib/alipay_submit.class.php';

        // 构造要请求的参数数组
        $parameter = array(
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
        );

        // 建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter, "get", "确认");
        return $html_text;
    }
}
