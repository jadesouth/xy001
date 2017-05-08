<?php

class Product extends Home_Controller
{
    /**
     * 订阅妹子页面
     */
    public function index()
    {
        $this->load->helper('http');
        $this->load->model('box_model');
        $box_id = (int)$this->input->get('id');
        $theme_id = (int)$this->input->get('theme_id');
        if (empty($box_id)) {
            $box_id = $this->box_model->getLastBoxId($theme_id);
        }
        $this->box_model->setSelectFields('*');
        $box_info = $this->box_model->find($box_id);
        $this->_viewVar['box_info'] = $box_info;
        $this->load_view();
    }

    public function all($tag_type = 'all')
    {
        $this->load->model('box_model');
        $tag_list = $this->box_model->readTagList();
        $this->_viewVar['tag_list'] = $tag_list;
        $this->_viewVar['body_attr'] = ' class="all-crates"';
        if (! empty($tag_list) && in_array(urldecode($tag_type), $tag_list)) {
            $conditions['AND']['tag'] = urldecode($tag_type);
            $this->_viewVar['box_list'] = $this->box_model->readBox(0, 0, 0, '*', 0, 100, '', $conditions);
        } elseif ($tag_type == 'month') {
            $year = date('Y', strtotime('-1 month'));
            $month = date('n', strtotime('-1 month'));
            $this->_viewVar['box_list'] = $this->box_model->readBox(0, $year, $month);
        } else {
            $this->_viewVar['box_list'] = $this->box_model->readBox();

        }
        $this->_viewVar['tag_type'] = $tag_type;
        $this->load_view();
    }

    public function checkout()
    {
        if (empty(intval($_GET['id'])) || empty(intval(intval($_GET['plan'])))) {
            show_404();
        }
        $box_id = intval($_GET['id']);
        $plan = intval($_GET['plan']);
        $this->load->model('box_model');
        $this->box_model->setSelectFields('*');
        $box_info = $this->box_model->find($box_id);
        if (empty($box_info)) {
            show_404();
        }
        $this->_viewVar['box_info'] = $box_info;
        $this->_viewVar['plan'] = $plan;
        $this->_viewVar['t_shirt_size'] = '';
        if (1 == $plan) {
            $this->_viewVar['price'] = $box_info['monthly_price'];
        } elseif (3 == $plan) {
            $this->_viewVar['price'] = $box_info['quarterly_price'];
        } elseif (6 == $plan) {
            $this->_viewVar['price'] = $box_info['semiannually_price'];
        } elseif (12 == $plan) {
            $this->_viewVar['price'] = $box_info['annually_price'];
            $this->_viewVar['t_shirt_size'] = str_replace(['1-', '2-'], ['男 - ', '女 - '], $_GET['tsize']);
        } else {
            show_404();
        }

        $this->_viewVar['body_attr'] = ' id="checkouts-steps"';
        $form_code = mt_rand(0,1000000);
        $this->session->set_userdata('checkout_code', $form_code);
        $this->_viewVar['form_code'] = $form_code;
        if (empty($this->_loginUser)) {
            $this->load_view('product/nologin_checkout.php');
        } else {
            $user_id = $this->_loginUser['id'];
            $this->load->model('user_model');
            $this->load->model('coupon_model');
            $this->_viewVar['user_info'] = $this->user_model->setSelectFields('id,post_name,post_phone,post_addr')->find($user_id);
            $this->_viewVar['coupons'] = $this->coupon_model
                ->setSelectFields('id,value,status,use_time,expiration_time,created_at')
                ->setAndCond(['user_id' => $this->_loginUser['id'], 'status' => 0, 'expiration_time>' => date('Y-m-d')])
                ->read();
            $this->load_view('product/checkout.php');
        }
    }

    public function ajaxGetBoxInfo()
    {
        if ('post' == $this->input->method()) {
            $this->load->helper('http');
            $box_id = (int)$this->input->post('id');
            if (empty($box_id)) {
                http_ajax_response(1, '非法请求', []);
                return;
            }
            $this->load->model('box_model');
            $this->box_model->setSelectFields('*');
            $box_info = $this->box_model->find($box_id);
            if (! empty($box_info)) {
                http_ajax_response(0, '成功', $box_info);
                return;
            }
            http_ajax_response(1, '请稍后再试试', []);
            return;
        }
        http_ajax_response(1, '非法请求', []);
    }

    public function nologin_pay()
    {
        if ('post' == $this->input->method()) {
            $this->load->helper('http');
            $this->load->helper('tools');
            $this->load->library('form_validation');
            if (false === $this->form_validation->run()) {
                layer_fail_response(trim(strip_tags($this->form_validation->error_string())));
            } else {
                $this->load->model('user_model');
                $this->load->model('coupon_model');
                $this->load->model('box_model');
                $this->load->model('order_model');
                $code = (int)$this->input->post('code');
                if (empty($code)) {
                    layer_fail_response('请求失败');
                }
                if (empty($_SESSION['checkout_code']) || $code != $_SESSION['checkout_code']) {
                    layer_fail_response('请求失败');
                }
                unset($_SESSION['checkout_code']);
                $box_id = (int)$this->input->post('box_id', true);
                $payway = $this->input->post('payway', true);
                $plan = (int)$this->input->post('plan', true);
                $tsize = (string)$this->input->post('tsize', true);
                $post_name = $this->input->post('post_name', true);
                $post_phone = $this->input->post('post_phone', true);
                $post_addr = $this->input->post('post_addr', true);
                $user_info['login_email'] = $this->input->post('post_email',true);
                $user_info['password'] = $this->input->post('password',true);
                $user_info['post_name'] = $post_name;
                $user_info['post_phone'] = $post_phone;
                $user_info['post_addr'] = $post_addr;
                $user_id = $this->user_model->add_user($user_info);
                $this->set_user_login($user_id,$user_info['login_email']);
                $user_info = $this->user_model->setSelectFields('*')->find($user_id);
                $box_info = $this->box_model->setSelectFields('*')->find($box_id);
                $coupon_info = [];
                if (empty($user_info) || empty($box_info)) {
                    layer_fail_response('非法参数');
                }
                $shirt_size = $shirt_sex = '';
                list($shirt_sex, $shirt_size) = explode('-', $tsize);
                if (! in_array($shirt_sex, [1, 2])) {
                    layer_fail_response('非法参数');
                }
                if (! in_array($shirt_size, ['S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL'])) {
                    layer_fail_response('非法参数');
                }
                if (1 == $plan) {
                    $order_value = $box_info['monthly_price'];
                } elseif (3 == $plan) {
                    $order_value = $box_info['quarterly_price'];
                } elseif (6 == $plan) {
                    $order_value = $box_info['semiannually_price'];
                } elseif (12 == $plan) {
                    $order_value = $box_info['annually_price'];
                } else {
                    show_404();
                }
                $extra_data = [
                    'order_number' => $this->order_model->generateOrderNumber(),
                    'plan'         => $plan,
                    'post_name'    => $post_name,
                    'post_phone'   => $post_phone,
                    'post_addr'    => $post_addr,
                    'order_value'  => $order_value,
                    'pay_value'    => empty($coupon_info) ? $order_value : $order_value - $coupon_info['value'],
                    'shirt_sex'    => $shirt_sex,
                    'shirt_size'   => $shirt_size,
                ];
                $create_return = $this->order_model->createOrder($user_info, $box_info, $coupon_info, $extra_data);
                if (! $create_return) {
                    layer_fail_response('创建订单失败');
                }
                $order_fee = $extra_data['pay_value'];
                $order_fee = '0.01';//deleteme
                $order_number = $extra_data['order_number'];
                $order_name = $box_info['theme_name'] . ' ' . $plan . '个月订阅'; // 订单名称
                $order_desc = $box_info['theme_name'] . ' ' . $plan . '个月订阅'; // 商品描述
                if ('alipay' == $payway) {
                    $this->load->library('Alipay');
                    if (is_mobile()) {
                        $htmlText = $this->alipay->createWapSubmit($user_id, $order_number, $order_name, $order_fee, $order_desc,true);
                        echo $htmlText;
                    } else {
                        $htmlText = $this->alipay->createWebSubmit($user_id, $order_number, $order_name, $order_fee, $order_desc,true);
                    }
                    echo $htmlText;
                } else { //微信支付
                    try {
                        $this->load->library('WeixinPay');
                        $notify_url = base_url('order/productPaymentWXNotify');
                        $order_create_info = $this->weixinpay->createOrder($user_id, $box_info['id'], $order_number, $order_name, $order_fee,$notify_url);
                        if ('SUCCESS' == $order_create_info['return_code'] && 'SUCCESS' == $order_create_info['result_code'] && ! empty($order_create_info['code_url'])) {
                            $this->_viewVar['order_number'] = $order_number;
                            $this->_viewVar['order_name'] = $order_name;
                            $this->_viewVar['order_fee'] = $order_fee;
                            $this->_viewVar['qrcode'] = urlencode($order_create_info['code_url']);
                            $this->load_view('order/wx');
                        } else {
                            show_error('微信支付错误', 500, '支付错误');
                        }
                    } catch (Exception $e) {
                        show_error($e->getMessage(), 500, '支付错误');
                    }
                }
            }

        }

    }

    public function pay()
    {
        if ('post' == $this->input->method()) {
            $this->load->helper('http');
            $this->load->helper('tools');
            $this->load->library('form_validation');
            if (false === $this->form_validation->run()) {
                layer_fail_response(trim(strip_tags($this->form_validation->error_string())));
            } else {
                $this->load->model('user_model');
                $this->load->model('coupon_model');
                $this->load->model('box_model');
                $this->load->model('order_model');
                $code = (int)$this->input->post('code');
                if (empty($code)) {
                    layer_fail_response('请求失败');
                }
                if (empty($_SESSION['checkout_code']) || $code != $_SESSION['checkout_code']) {
                    layer_fail_response('请求失败');
                }
                unset($_SESSION['checkout_code']);
                $user_id = (int)$this->_loginUser['id'];
                if(empty($user_id)){
                    layer_fail_response('请重新再试');
                }
                $box_id = (int)$this->input->post('box_id',true);
                $payway = $this->input->post('payway',true);
                $coupon_id = (int)$this->input->post('coupon',true);
                $plan = (int)$this->input->post('plan',true);
                $tsize = (string)$this->input->post('tsize',true);
                $post_name = $this->input->post('post_name',true);
                $post_phone = $this->input->post('post_phone',true);
                $post_addr = $this->input->post('post_addr',true);
                $user_info = $this->user_model->setSelectFields('*')->find($user_id);
                $box_info = $this->box_model->setSelectFields('*')->find($box_id);
                $coupon_info = $this->coupon_model->setSelectFields('*')
                                                  ->setAndCond(['user_id' => $this->_loginUser['id'], 'status' => 0, 'expiration_time>' => date('Y-m-d'), 'id' => $coupon_id])
                                                  ->get();
                if (empty($user_info) || empty($box_info) || (! empty($coupon_id) && empty($coupon_info))) {
                    layer_fail_response('非法参数');
                }
                $update_data['post_name'] = $post_name;
                $update_data['post_phone'] = $post_phone;
                $update_data['post_addr'] = $post_addr;
                $return = $this->user_model->modify($user_id, $update_data);
                $shirt_size = $shirt_sex = '';
                list($shirt_sex, $shirt_size) = explode('-', $tsize);
                if (! in_array($shirt_sex, [1, 2])) {
                    layer_fail_response('非法参数');
                }
                if (! in_array($shirt_size, ['S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL'])) {
                    layer_fail_response('非法参数');
                }
                if (1 == $plan) {
                    $order_value = $box_info['monthly_price'];
                } elseif (3 == $plan) {
                    $order_value = $box_info['quarterly_price'];
                } elseif (6 == $plan) {
                    $order_value = $box_info['semiannually_price'];
                } elseif (12 == $plan) {
                    $order_value = $box_info['annually_price'];
                } else {
                    show_404();
                }
                $extra_data = [
                    'order_number' => $this->order_model->generateOrderNumber(),
                    'plan'         => $plan,
                    'post_name'    => $post_name,
                    'post_phone'   => $post_phone,
                    'post_addr'    => $post_addr,
                    'order_value'  => $order_value,
                    'pay_value'    => empty($coupon_info) ? $order_value : $order_value - $coupon_info['value'],
                    'shirt_sex'    => $shirt_sex,
                    'shirt_size'   => $shirt_size,
                ];
                $create_return = $this->order_model->createOrder($user_info, $box_info, $coupon_info, $extra_data);
                if (! $create_return) {
                    layer_fail_response('创建订单失败');
                }
                $order_fee = $extra_data['pay_value'];
                $order_fee = '0.01';//deleteme
                $order_number = $extra_data['order_number'];
                $order_name = $box_info['theme_name'] . ' ' . $plan . '个月订阅'; // 订单名称
                $order_desc = $box_info['theme_name'] . ' ' . $plan . '个月订阅'; // 商品描述
                if ('alipay' == $payway) {
                    $this->load->library('Alipay');
                    if (is_mobile()) {
                        $htmlText = $this->alipay->createWapSubmit($user_id, $order_number, $order_name, $order_fee, $order_desc);
                        echo $htmlText;
                    } else {
                        $htmlText = $this->alipay->createWebSubmit($user_id, $order_number, $order_name, $order_fee, $order_desc);
                    }
                    echo $htmlText;
                } else { //微信支付
                    try {
                        $this->load->library('WeixinPay');
                        $notify_url = base_url('order/productPaymentWXNotify');
                        $order_create_info = $this->weixinpay->createOrder($user_id, $box_info['id'], $order_number, $order_name, $order_fee,$notify_url);
                        if ('SUCCESS' == $order_create_info['return_code'] && 'SUCCESS' == $order_create_info['result_code'] && ! empty($order_create_info['code_url'])) {
                            $this->_viewVar['order_number'] = $order_number;
                            $this->_viewVar['order_name'] = $order_name;
                            $this->_viewVar['order_fee'] = $order_fee;
                            $this->_viewVar['qrcode'] = urlencode($order_create_info['code_url']);
                            $this->load_view('order/wx');
                        } else {
                            show_error('微信支付错误', 500, '支付错误');
                        }
                    } catch (Exception $e) {
                        show_error($e->getMessage(), 500, '支付错误');
                    }
                }

            }

        }

    }


}
