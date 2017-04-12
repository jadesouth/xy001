<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Order 订单管理控制器
 */
class Order extends Admin_Controller
{
    /**
     * index
     * @param int $page
     */
    public function index($page = 0)
    {
        // 分页页码
        $page = 0 >= $page ? 1 : $page;

        // view data
        $this->_headerViewVar['h1_title'] = $this->_adminConfig[$this->_className][__FUNCTION__];
        $this->_headerViewVar['method_name'] = __FUNCTION__;

        // 获取记录总条数
        $count = $this->_model->count();
        if(! empty($count)) {
            $view_orders = [];
            // Page configure
            $this->load->library('pagination');
            $config['base_url'] = base_url("admin/{$this->_className}/index");
            $config['total_rows'] = (int)$count;
            $this->pagination->initialize($config);
            $this->_viewVar['page'] = $this->pagination->create_links();
            // get page data
            $orders = $this->_model
                ->setSelectFields('id,order_number,plan_number,post_name,post_phone,post_addr')
                ->getPage($page, ADMIN_PAGE_SIZE);
            if (! empty($orders)) {
                $current_date = date('Y-m-d');
                $year = date('Y');
                $month = date('m');
                if (12 <= $month) {
                    $next_year = $year + 1;
                    $next_month = 1;
                } else {
                    $next_year = $year;
                    $next_month = $month + 1;
                }

                $order_ids = array_column($orders, 'id');
                $this->load->model('order_plan_model');
                $order_plans = $this->order_plan_model
                    ->setSelectFields('id,order_id,plan_year,plan_month,plan_date,status')
                    ->setConditions(['AND' => ['order_id []' => $order_ids]])
                    ->read();
                $order_play_info = [];
                if (! empty($order_plans)) {
                    foreach ($order_plans as $order_plan) {
                        // 已完成的计划期数
                        if ($order_plan['plan_date'] < $current_date && 0 == $order_plan['status']) {
                            if (isset($order_play_info[$order_plan['order_id']]['completed'])) {
                                $order_play_info[$order_plan['order_id']]['completed']++;
                            } else {
                                $order_play_info[$order_plan['order_id']]['completed'] = 1;
                            }
                        }
                        // 下次邮寄日期
                        if ($order_plan['plan_date'] <= $current_date) {
                            if ((int)$year == (int)$order_plan['plan_year'] && (int)$month == (int)$order_plan['plan_month']) {
                                $order_play_info[$order_plan['order_id']]['plan_date'] = $order_plan['plan_date'];
                            }
                        } else {
                            if ((int)$year == (int)$order_plan['plan_year'] && (int)$month == (int)$order_plan['plan_month']) {
                                $order_play_info[$order_plan['order_id']]['plan_date'] = $order_plan['plan_date'];
                            }
                            if ((int)$next_year == (int)$order_plan['plan_year'] && (int)$next_month == (int)$order_plan['plan_month'] && empty($order_play_info[$order_plan['order_id']]['plan_date'])) {
                                $order_play_info[$order_plan['order_id']]['plan_date'] = $order_plan['plan_date'];
                            }
                        }
                    }
                }
                foreach ($orders as &$order) {
                    $order['completed'] = isset($order_play_info[$order['id']]['completed']) ? $order_play_info[$order['id']]['completed'] : 0;
                    $order['plan_date'] = isset($order_play_info[$order['id']]['plan_date']) ? $order_play_info[$order['id']]['plan_date'] : 0;
                }
            }

            $this->_viewVar['data'] = $orders;
        }
        // 加载视图
        $this->load_view();
    }

    /**
     * ajax_disable 禁用账号
     */
    public function ajax_disable()
    {
        $this->load->helper('http');
        $user_id = (int)$this->input->post('user_id', 0);
        if (0 >= $user_id) {
            http_ajax_response(1, '非法请求');
            return;
        }

        $this->load->model('theme_model');
        if (true == $this->theme_model->modify($user_id, ['status' => 1])) {
            http_ajax_response(0, '关闭权限成功');
        } else {
            http_ajax_response(2, '关闭权限成功');
        }
    }
}
