<?php

class Gift extends Home_Controller
{
    /**
     * index 订购礼物
     *
     */
    public function index()
    {
        $this->load->model('box_model');
        $year = date('Y', strtotime('-1 month'));
        $month = date('n', strtotime('-1 month'));
        $this->_viewVar['gift_list'] = $this->box_model->readBox(0, $year, $month);
        $this->_viewVar['coupons'] = [];
        $this->load->model('coupon_model');
        if ($this->is_login()) {
            $this->_viewVar['coupons'] = $this->coupon_model
                ->setSelectFields('id,value,status,use_time,expiration_time,created_at')
                ->setAndCond(['user_id' => $this->_loginUser['id'], 'status' => 0, 'expiration_time>' => date('Y-m-d')])
                ->read();
        }
        $this->load_view();
    }

    public function pay()
    {
        if ('post' == $this->input->method()) {
            $this->load->helper('http');
            $this->load->helper('tools');
            $this->load->library('form_validation');
            if (false === $this->form_validation->run()) {
                layer_fail_response($this->form_validation->error_string(), 3000);
            } else {
                $this->load->model('user_model');
                $this->load->model('box_model');
                $this->load->model('order_model');
                $box_id = (int)$this->input->post('box_id', true);
                $plan = $this->input->post('plan', true);
                $shirt_sex = (string)$this->input->post('shirt_sex', true);
                $shirt_size = (string)$this->input->post('shirt_size', true);
                $post_name = $this->input->post('post_name', true);
                $post_phone = $this->input->post('post_phone', true);
                $post_addr = $this->input->post('post_addr', true);
                $gift_email = $this->input->post('gift_email', true);
                $sender_name = $this->input->post('sender_name', true);
                $payway = $this->input->post('pay', true);
                $box_info = $this->box_model->setSelectFields('*')->find($box_id);
                if (empty($box_info)) {
                    layer_fail_response('非法参数');
                }
                if (1 == $plan) {
                    $order_value = $box_info['monthly_price'];
                } elseif (3 == $plan) {
                    $order_value = $box_info['quarterly_price'];
                } elseif (6 == $plan) {
                    $order_value = $box_info['semiannually_price'];
                } elseif (12 == $plan) {
                    $order_value = $box_info['annually_price'];;
                    if (! in_array($shirt_sex, [1, 2])) {
                        layer_fail_response('非法参数');
                    }
                    if (! in_array($shirt_size, ['S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL'])) {
                        layer_fail_response('非法参数');
                    }
                } else {
                    show_404();
                }
                if ($this->is_login()) {
                    $user_id = (int)$this->_loginUser['id'];
                    if(empty($user_id)){
                        layer_fail_response('请重新再试');
                    }
                    $coupon_id = $this->input->post('coupon',true);
                    $this->load->model('coupon_model');
                    $coupon_info = $this->coupon_model->setSelectFields('*')
                                                      ->setAndCond(['user_id' => $this->_loginUser['id'], 'status' => 0, 'expiration_time>' => date('Y-m-d'), 'id' => $coupon_id])
                                                      ->get();
                    $user_info = $this->user_model->setSelectFields('*')->find($user_id);
                    if (empty($user_info) || (! empty($coupon_id) && empty($coupon_info))) {
                        layer_fail_response('非法参数');
                    }

                } else {
                    $user_email = $this->input->post('user_email', true);
                    $user_password = $this->input->post('user_password', true);
                    $this->user_model->setConditions(['login_email' => $user_email, 'status' => 0]);
                    $this->user_model->setSelectFields('*');
                    $user_info = $this->user_model->get();
                    if (empty($user_info)) {
                        layer_fail_response('您的邮箱未注册');
                    }
                    $this->load->helper('security');
                    if ($user_info['password'] !== generate_admin_password($user_password, $user_info['salt'])) {
                        layer_fail_response('登录密码错误');
                    }

                    $this->set_user_login($user_info['id'], $user_info['id']);
                    $coupon_info = [];
                }
                $extra_data = [
                    'order_number'     => $this->order_model->generateOrderNumber(),
                    'plan'             => $plan,
                    'post_name'        => $post_name,
                    'post_phone'       => $post_phone,
                    'post_addr'        => $post_addr,
                    'order_value'      => $order_value,
                    'pay_value'        => empty($coupon_info) ? $order_value : $order_value - $coupon_info['value'],
                    'shirt_sex'        => $shirt_sex,
                    'shirt_size'       => $shirt_size,
                    'is_gift'          => 1,
                    'gift_email'       => $gift_email,
                    'gift_sender_name' => $sender_name,
                ];
                $create_return = $this->order_model->createOrder($user_info, $box_info, $coupon_info, $extra_data);
                if (! $create_return) {
                    layer_fail_response('创建订单失败');
                }
                if (is_mobile() && $payway == 'alipay') { //手机wap
                    $orderFee = $extra_data['pay_value'];
                    $orderFee = '0.01';//deleteme
                    $orderNumber = $extra_data['order_number'];
                    $orderName = $box_info['theme_name'] . ' ' . $plan . '个月订阅'; // 订单名称
                    $orderDesc = $box_info['theme_name'] . ' ' . $plan . '个月订阅'; // 商品描述
                    $this->load->library('Alipay');
                    $htmlText = $this->alipay->createWapSubmit($user_info['id'], $orderNumber, $orderName, $orderFee, $orderDesc);
                    echo $htmlText;
                }
            }
        }
    }
}
