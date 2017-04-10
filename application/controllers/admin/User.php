<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class User 用户控制器
 */
class User extends Admin_Controller
{
    /**
     * index 全部用户列表
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
            $this->_viewVar['data'] = $this->_model
                ->setSelectFields($this->_adminConfig[$this->_className]['index_field'])
                ->getPage($page, ADMIN_PAGE_SIZE);
        }
        // 加载视图
        $this->load_view();
    }

    /**
     * ajaxDisable 禁用账号
     */
    public function ajaxDisable()
    {
        $this->load->helper('http');
        $user_id = (int)$this->input->post('user_id', 0);
        if (0 >= $user_id) {
            http_ajax_response(1, '非法请求');
            return;
        }

        $this->load->model('user_model');
        if (true == $this->user_model->modify($user_id, ['status' => 1])) {
            http_ajax_response(0, '禁止登录成功');
        } else {
            http_ajax_response(2, '禁止登录失败');
        }
    }

    /**
     * ajaxEnable 启用账号
     */
    public function ajaxEnable()
    {
        $this->load->helper('http');
        $user_id = (int)$this->input->post('user_id', 0);
        if (0 >= $user_id) {
            http_ajax_response(1, '非法请求');
            return;
        }

        $this->load->model('user_model');
        if (true == $this->user_model->modify($user_id, ['status' => 0])) {
            http_ajax_response(0, '开启登录成功');
        } else {
            http_ajax_response(2, '开启登录失败');
        }
    }

    /**
     * detail 用户详情
     */
    public function detail()
    {
        $this->load->helper('http');
        $user_id = (int)$this->input->post('user_id', 0);
        if (0 >= $user_id) {
            http_ajax_response(1, '非法请求');
            return;
        }

        // 获取用户信息
        $this->load->model('user_model');
        $user_info = $this->user_model
            ->setSelectFields('*')
            ->find($user_id);
        if (empty($user_info)) {
            http_ajax_response(2, '获取信息失败');
        } else {
            http_ajax_response(0, 'OK', $user_info);
        }
    }
}
