<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Menu 菜单管理控制器
 */
class Menu extends Admin_Controller
{
    /**
     * index
     *
     * @param int $page
     *
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
        if (! empty($count)) {
            // Page configure
            $this->load->library('pagination');
            $config['base_url'] = base_url("admin/{$this->_className}/index");
            $config['total_rows'] = (int)$count;
            $this->pagination->initialize($config);
            $this->_viewVar['page'] = $this->pagination->create_links();
            // get page data
            $this->_viewVar['data'] = $this->_model
                ->setSelectFields($this->_adminConfig[$this->_className]['index_field'])
                ->getPage($page, ADMIN_PAGE_SIZE,'list_order desc');
        }
        // 加载视图
        $this->load_view();
    }

    /**
     * ajaxDisable 设置菜单隐藏
     */
    public function ajaxDisable()
    {
        $this->load->helper('http');
        $menu_id = (int)$this->input->post('menu_id', 0);
        if (0 >= $menu_id) {
            http_ajax_response(1, '非法请求');
            return;
        }

        $this->load->model('menu_model');
        if (true == $this->menu_model->modify($menu_id, ['status' => 1])) {
            http_ajax_response(0, '设置菜单隐藏成功');
        } else {
            http_ajax_response(2, '设置菜单隐藏失败');
        }
    }

    /**
     * ajaxEnable 设置菜单显示
     */
    public function ajaxEnable()
    {
        $this->load->helper('http');
        $menu_id = (int)$this->input->post('menu_id', 0);
        if (0 >= $menu_id) {
            http_ajax_response(1, '非法请求');
            return;
        }

        $this->load->model('menu_model');
        if (true == $this->menu_model->modify($menu_id, ['status' => 0])) {
            http_ajax_response(0, '设置菜单显示成功');
        } else {
            http_ajax_response(2, '设置菜单显示失败');
        }
    }

    /**
     * detail 菜单详情
     */
    public function detail()
    {
        $this->load->helper('http');
        $menu_id = (int)$this->input->post('menu_id', 0);
        if (0 >= $menu_id) {
            http_ajax_response(1, '非法请求');
            return;
        }

        // 获取用户信息
        $this->load->model('menu_model');
        $menu_info = $this->menu_model
            ->setSelectFields('*')
            ->find($menu_id);
        if (empty($menu_info)) {
            http_ajax_response(2, '获取信息失败');
        } else {
            http_ajax_response(0, 'OK', $menu_info);
        }
    }

    /**
     * ajaxDelete 删除菜单
     */
    public function ajaxDelete()
    {
        $this->load->helper('http');
        $menu_id = (int)$this->input->post('menu_id', 0);
        if (0 >= $menu_id) {
            http_ajax_response(1, '非法请求');
            return;
        }

        $this->load->model('menu_model');
        if (true == $this->menu_model->remove($menu_id)) {
            http_ajax_response(0, '删除成功');
        } else {
            http_ajax_response(2, '删除失败');
        }
    }
}
