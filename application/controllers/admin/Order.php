<?php

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
            // Page configure
            $this->load->library('pagination');
            $config['base_url'] = base_url("admin/{$this->_className}/index");
            $config['total_rows'] = (int)$count;
            $this->pagination->initialize($config);
            $this->_viewVar['page'] = $this->pagination->create_links();
            // get page data
            $orders = $this->_model
                ->setSelectFields('id,order_number,plan_number,post_name,post_phone,post_addr,created_at')
                ->setAndCond(['status []' => [1, 2]])
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
                    ->setSelectFields('id,order_id,plan_year,plan_month,plan_date,sign,status')
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
                            if ((int)$year == (int)$order_plan['plan_year'] && (int)$month == (int)$order_plan['plan_month']) { // 当月
                                $order_play_info[$order_plan['order_id']]['plan_date'] = $order_plan['plan_date'];
                                $order_play_info[$order_plan['order_id']]['order_plan_id'] = $order_plan['id'];
                                $order_play_info[$order_plan['order_id']]['sign'] = $order_plan['sign'];
                            }
                        } else {
                            if ((int)$year == (int)$order_plan['plan_year'] && (int)$month == (int)$order_plan['plan_month']) { // 当月
                                $order_play_info[$order_plan['order_id']]['plan_date'] = $order_plan['plan_date'];
                                $order_play_info[$order_plan['order_id']]['order_plan_id'] = $order_plan['id'];
                                $order_play_info[$order_plan['order_id']]['sign'] = $order_plan['sign'];
                            }
                            // 下月
                            if ((int)$next_year == (int)$order_plan['plan_year'] && (int)$next_month == (int)$order_plan['plan_month'] && empty($order_play_info[$order_plan['order_id']]['plan_date'])) {
                                $order_play_info[$order_plan['order_id']]['plan_date'] = $order_plan['plan_date'];
                                $order_play_info[$order_plan['order_id']]['order_plan_id'] = $order_plan['id'];
                                $order_play_info[$order_plan['order_id']]['sign'] = $order_plan['sign'];
                            }
                        }
                    }
                }
                foreach ($orders as &$order) {
                    $order['completed'] = isset($order_play_info[$order['id']]['completed']) ? $order_play_info[$order['id']]['completed'] : 0;
                    $order['plan_date'] = isset($order_play_info[$order['id']]['plan_date']) ? $order_play_info[$order['id']]['plan_date'] : 0;
                    $order['order_plan_id'] = isset($order_play_info[$order['id']]['order_plan_id']) ? $order_play_info[$order['id']]['order_plan_id'] : 0;
                    $order['sign'] = isset($order_play_info[$order['id']]['sign']) ? $order_play_info[$order['id']]['sign'] : -1;
                }
            }

            $this->_viewVar['data'] = $orders;
        }
        // 加载视图
        $this->load_view();
    }

    /**
     * nextPlan 下期计划列表
     *
     * @param int $page
     */
    public function nextPlan($page = 0)
    {
        // 分页页码
        $page = 0 >= $page ? 1 : $page;

        // view data
        $this->_headerViewVar['h1_title'] = $this->_adminConfig[$this->_className][__FUNCTION__];
        $this->_headerViewVar['method_name'] = __FUNCTION__;

        // 获取记录总条数
        $count = $this->_model->nextPlanCount();
        if(! empty($count)) {
            // Page configure
            $this->load->library('pagination');
            $config['base_url'] = base_url("admin/{$this->_className}/nextPlan");
            $config['total_rows'] = (int)$count;
            $this->pagination->initialize($config);
            $this->_viewVar['page'] = $this->pagination->create_links();
            // get page data
            $this->_viewVar['data'] = $this->_model->nextPlan($page, ADMIN_PAGE_SIZE);
        }
        // 加载视图
        $this->load_view();
    }

    /**
     * detail 订单详情
     */
    public function detail()
    {
        // view data
        $this->_headerViewVar['h1_title'] = '盒子详情';
        $this->_headerViewVar['method_name'] = __FUNCTION__;
        $order_id = (int)$this->input->get('order', true);
        if (0 >= $order_id) {
            $this->load_view();
            return;
        }

        // 获取订单基本信息
        $order = $this->_model->setSelectFields('*')
            ->setConditions(['id' => $order_id])->get();
        $this->_viewVar['order'] = $order;
        if (! empty($order)) {
            // 获取订单计划信息
            $this->load->model('order_plan_model');
            $order_plans = $this->order_plan_model
                ->setSelectFields('*')
                ->setConditions(['order_id' => $order_id])
                ->read();
            $this->_viewVar['order_plans'] = $order_plans;
            // 获取下订单用户信息
            $this->load->model('user_model');
            $user = $this->user_model->setSelectFields('*')
                ->setAndCond(['id' => $order['user_id']])
                ->get();
            $this->_viewVar['user'] = $user;
            // 获取盒子名称
            $this->load->model('box_model');
            $box_name = $this->box_model->setSelectFields('name')
                ->setAndCond(['id' => $order['box_id']])
                ->get();
            $this->_viewVar['box'] = $box_name;
        }

        $this->load_view();
    }

    /**
     * setSign 标记订单计划状态
     */
    public function setSign()
    {
        $this->load->helper('http');
        $order_plan_id = (int)$this->input->post('order_plan', 0);
        if (0 >= $order_plan_id) {
            http_ajax_response(1, '非法请求');
            return;
        }

        $this->load->model('order_plan_model');
        if (true == $this->order_plan_model->modify($order_plan_id, ['sign' => 1])) {
            http_ajax_response(0, '状态标记成功');
        } else {
            http_ajax_response(2, '状态标记失败');
        }
    }
}
