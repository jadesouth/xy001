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
        $this->_viewVar['table_header'] = $this->_adminConfig[$this->_className]['table_header'];

        // 获取记录总条数
        $count = $this->_model->count();
        if(! empty($count)) {
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
                $year = date('Y');
                $month = date('m');
                $order_ids = array_column($orders, 'id');
                $this->load->model('order_plan_model');
                $order_plans = $this->order_plan_model
                    ->setSelectFields('id,order_id,plan_year,plan_month,plan_date,status')
                    ->setConditions(['order_id' => $order_ids])
                    ->get();
                $order_play_info = [];
                if (! empty($order_plans)) {
                    foreach ($order_plans as $order_plan) {
                        
                        isset($order_play_info[$order_plan['order_id']][''])
                    }
                }
                foreach ($orders as $order) {

                }
            }

            $this->_viewVar['data'] = '';
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
