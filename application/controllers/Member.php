<?php

/**
 * Class Member
 */
class Member extends Home_Controller
{
    /**
     * Member constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
    }

    /**
     * order 订单列表
     */
    public function order()
    {
        $condition['AND'] = [
            'user_id'   => $this->_loginUser['id'],
            'status []' => [1, 2],
        ];
        $fields = 'id,order_number,box_id,box_name,plan_number,shirt_sex,shirt_size,post_name,post_phone,post_addr,created_at';
        $this->load->model('order_model');
        $orders = $this->order_model
            ->setSelectFields($fields)
            ->setConditions($condition)
            ->read();
        $orders = array_column($orders, null, 'id');
        $this->_viewVar['order_numbers'] = array_column($orders, 'order_number');
        $this->_viewVar['next_plan_date'] = '已完成计划';
        if (! empty($orders)) {
            $order_ids = array_column($orders, 'id');
            $this->load->model('order_plan_model');
            $order_plans = $this->order_plan_model
                ->setSelectFields('order_id,plan_year,plan_month,plan_date,status')
                ->setAndCond(['order_id []' => $order_ids])
                ->read();
            $current_date = date('Y-m-d');
            $current_year = date('Y');
            $current_month = date('m');
            $next_month_timestamp = strtotime(date('Y-m-d') . ' +1 month');
            $next_year = (int)date('Y', $next_month_timestamp);
            $next_month = (int)date('m', $next_month_timestamp);
            array_walk($orders, function (&$item, $key) {
                $item['next_plan_date'] = '订单完成';
                $item['next_plan_status'] = '订单完成';
                $item['next_month_active'] = -1;
            });
            foreach ($order_plans as $order_plan) {
                if ($current_year == $order_plan['plan_year'] && $current_month == $order_plan['plan_month'] && $current_date <= $order_plan['plan_date']) {
                    if (0 == $order_plan['status']) {
                        $orders[$order_plan['order_id']]['next_plan_date'] = $order_plan['plan_date'];
                        $orders[$order_plan['order_id']]['next_plan_status'] = '当月未发';
                    } else {
                        $orders[$order_plan['order_id']]['next_plan_status'] = '当月暂停';
                    }
                } elseif ($current_year == $order_plan['plan_year'] && $current_month == $order_plan['plan_month'] && $current_date > $order_plan['plan_date']) {
                    if (0 == $order_plan['status']) {
                        $orders[$order_plan['order_id']]['next_plan_status'] = '当月已发';
                    } else {
                        $orders[$order_plan['order_id']]['next_plan_status'] = '当月暂停';
                    }

                }
                if ($next_year == $order_plan['plan_year'] && $next_month == $order_plan['plan_month'] && '当月未发' != $orders[$order_plan['order_id']]['next_plan_status']) {
                    $orders[$order_plan['order_id']]['next_plan_date'] = $order_plan['plan_date'];
                    $orders[$order_plan['order_id']]['next_plan_status'] = '订单继续';
                }
                // 判断下月的寄送状态
                if ($next_year == $order_plan['plan_year'] && $next_month == $order_plan['plan_month']) {
                    $orders[$order_plan['order_id']]['next_month_active'] = $order_plan['status'];
                }
            }
        }

        // 查询需要升级的订单
        $this->_viewVar['upgrade_orders'] = $this->order_model
            ->setSelectFields('id,order_number,box_name')
            ->setAndCond([
                'user_id'        => $this->_loginUser['id'],
                'plan_number !=' => 12,
                'status []'      => [1, 2],
            ])
            ->read();

        $this->_viewVar['orders'] = $orders;
        $this->_viewVar['body_attr'] = ' id="user_accounts-subscriptions" class="user_accounts subscriptions is-mobile"';
        $this->_viewVar['sex'] = [1 => '男', 2 => '女'];
        $this->load_view();
    }

    /**
     * coupon 优惠券
     */
    public function coupon()
    {
        $this->load->model('coupon_model');
        $this->_viewVar['coupons'] = $this->coupon_model
            ->setSelectFields('id,value,status,use_time,expiration_time,created_at')
            ->setAndCond(['user_id' => $this->_loginUser['id']])
            ->read();

        if (! empty($this->_viewVar['coupons'])) {
            foreach ($this->_viewVar['coupons'] as &$coupon) {
                $coupon['use_time'] = date('Y-m-d', strtotime($coupon['created_at'])) . '-' . $coupon['expiration_time'];
                if (date('Y-m-d') > $coupon['expiration_time'] && 0 == $coupon['status']) { // 未使用已过期
                    $coupon['status'] = 2;
                }
            }
        }

        // 查询需要升级的订单
        $this->load->model('order_model');
        $this->_viewVar['upgrade_orders'] = $this->order_model
            ->setSelectFields('id,order_number,box_name')
            ->setAndCond([
                'user_id'        => $this->_loginUser['id'],
                'plan_number !=' => 12,
                'status []'      => [1, 2],
            ])
            ->read();

        $this->_viewVar['body_attr'] = ' id="user_accounts-subscriptions" class="user_accounts subscriptions is-mobile"';
        $this->load_view();
    }

    public function account()
    {
        $user_id = $this->_loginUser['id'];
        $this->load->model('user_model');
        $user_info = $this->user_model->setSelectFields('id,login_email,name,post_name,created_at')->find($user_id);
        $this->_viewVar['user_info'] = $user_info;
        $this->_viewVar['body_attr'] = ' id="user_accounts-index" class="user_accounts subscriptions is-mobile"';
        $this->load_view();
    }

    /**
     * orderDetail 订单详情
     */
    public function orderDetail()
    {
        $order_id = $this->input->get('order', true);
        if (0 >= $order_id) {
            show_404();
        }

        $this->load->model('order_model');
        $order = $this->order_model
            ->setSelectFields('id,order_number,coupon_value,box_name,plan_number,post_name,post_phone,post_addr,created_at')
            ->setAndCond(['id' => $order_id, 'status []' => [1, 2], 'user_id' => $this->_loginUser['id']])
            ->get();
        $this->_viewVar['order'] = $order;

        $this->load->model('order_plan_model');
        $order_plans = $this->order_plan_model
            ->setSelectFields('plan_year,plan_month,plan_date,status')
            ->setAndCond(['order_id' => $order_id])
            ->read();
        if (! empty($order_plans)) {
            $current_date = date('Y-m-d');
            $current_year = date('Y');
            $current_month = date('m');
            foreach ($order_plans as &$order_plan) {
                if (1 == $order_plan['status']) {
                    $order_plan['status_msg'] = '已暂停';
                } else {
                    if ($current_year == $order_plan['plan_year']) {
                        if ($current_month > $order_plan['plan_month']) {
                            $order_plan['status_msg'] = '已完成';
                        } elseif ($current_month == $order_plan['plan_month']) {
                            if ($current_date > $order_plan['plan_date']) {
                                $order_plan['status_msg'] = '已完成';
                            } else {
                                $order_plan['status_msg'] = '未完成';
                            }
                        } else {
                            $order_plan['status_msg'] = '未完成';
                        }
                    } elseif ($current_year < $order_plan['plan_year']) {
                        $order_plan['status_msg'] = '未完成';
                    }
                }
            }
            $end_order_plan = end($order_plans);
            if (! empty($end_order_plan)) {
                if ($current_date > $end_order_plan['plan_date']) {
                    $order_status_msg = '已完成';
                }
            }
        }

        $this->_viewVar['order_plans'] = $order_plans;
        $this->_viewVar['body_attr'] = ' id="subscriptions-order_history" class="user_accounts subscriptions is-mobile"';
        $this->_viewVar['order_status_msg'] = empty($order_status_msg) ? '未完成' : $order_status_msg;
        $this->_viewVar['body_attr'] = ' id="subscriptions-order_history" class="user_accounts subscriptions is-mobile"';
        $this->load_view();
    }

    /**
     * cancelNextPlan 取消下月计划
     *
     * @return bool
     */
    public function cancelNextPlan()
    {
        $order_id = $this->input->post('order', true);
        $this->load->helper('http');
        if (0 >= $order_id) {
            http_ajax_response(1, '订单信息有误');

            return false;
        }

        $next_month_timestamp = strtotime(date('Y-m-d') . ' +1 month');
        $next_year = (int)date('Y', $next_month_timestamp);
        $next_month = (int)date('m', $next_month_timestamp);

        $this->load->model('order_plan_model');
        $this->order_plan_model
            ->setAndCond(['order_id' => $order_id, 'plan_year' => $next_year, 'plan_month' => $next_month])
            ->setUpdateData(['status' => 1])
            ->update();

        http_ajax_response(0, 'OK');

        return true;
    }

    /**
     * openNextPlan 开启下月计划
     *
     * @return bool
     */
    public function openNextPlan()
    {
        $order_id = $this->input->post('order', true);
        $this->load->helper('http');
        if (0 >= $order_id) {
            http_ajax_response(1, '订单信息有误');

            return false;
        }

        $next_month_timestamp = strtotime(date('Y-m-d') . ' +1 month');
        $next_year = (int)date('Y', $next_month_timestamp);
        $next_month = (int)date('m', $next_month_timestamp);

        $this->load->model('order_plan_model');
        $this->order_plan_model
            ->setAndCond(['order_id' => $order_id, 'plan_year' => $next_year, 'plan_month' => $next_month])
            ->setUpdateData(['status' => 0])
            ->update();

        http_ajax_response(0, 'OK');

        return true;
    }
}
