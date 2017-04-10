<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Thema 主题管理控制器
 */
class Theme extends Admin_Controller
{
    /**
     * index
     *
     * @param int $page
     *
     * @author wangnan <wangnanphp@163.com>
     * @date 2017-04-09 14:41:53
     */
    public function index(int $page = 0)
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
     * ajax_disable
     * 禁用账号
     *
     * @author haokaiyang
     * @date   2016-11-12 23:49:39
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
