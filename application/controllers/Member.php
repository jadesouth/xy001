<?php

/**
 * Class Member
 */
class Member extends Home_Controller
{
    /**
     * order 订单列表
     */
    public function order()
    {
        $condition['AND'] = [
            'user_id' => 1,
            'status'  => 1,
        ];
        $fields = 'id,order_number,box_id,box_name,plan_number,shirt_sex,shirt_size,post_name,post_phone,post_addr,created_at';
        $this->load->model('order_model');
        $orders = $this->order_model
            ->setSelectFields($fields)
            ->setConditions($condition)
            ->read();
        $orders = array_column($orders, null, 'id');
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
            if (12 <= $current_month) {
                $next_year = $current_year + 1;
                $next_month = 1;
            } else {
                $next_year = $current_year;
                $next_month = $current_month + 1;
            }
            array_walk($orders, function(&$item, $key) {
                $item['next_plan_date'] = '订单完成';
                $item['next_plan_status'] = '订单完成';
            });
            foreach ($order_plans as $order_plan) {
                if ($current_year == $order_plan['plan_year'] && $current_month == $order_plan['plan_month'] && $current_date <= $order_plan['plan_date']) {
                    $orders[$order_plan['order_id']]['next_plan_date'] = $order_plan['plan_date'];
                    $orders[$order_plan['order_id']]['next_plan_status'] = '当月未发';
                    break;
                }
                if ($next_year == $order_plan['plan_year'] && $next_month == $order_plan['plan_month']) {
                    $orders[$order_plan['order_id']]['next_plan_date'] = $order_plan['plan_date'];
                    $orders[$order_plan['order_id']]['next_plan_status'] = '当月已发';
                    break;
                }
            }
        }

        $this->_viewVar['orders'] = $orders;
        $this->_viewVar['body_attr'] = ' id="user_accounts-subscriptions" class="user_accounts subscriptions is-mobile"';
        $this->_viewVar['sex'] = [1 => '男', 2 => '女'];
        $this->load_view();
    }
}
