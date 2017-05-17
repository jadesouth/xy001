<?php

class Past extends Home_Controller
{
    /**
     * index 往期回顾
     */
    public function index()
    {
        $this->load->model('box_model');
        $theme_and_year = $this->box_model->readAllThemeAndYear();
        $this->_viewVar['theme_and_year'] = $theme_and_year;
        $this->load->helper('http');
        $year = (int)$this->input->get('year');
        $theme_id = (int)$this->input->get('theme_id');
        $month = 0;
        if (empty($year) && empty($theme_id)) {
            $year = date('Y', strtotime('-1 month'));
            $month = date('n', strtotime('-1 month'));
        }
        $select_fields = 'id,theme_id,theme_name,year,month,cover_title,cover_subtitle,cover_image';
        $box_list = $this->box_model->readBox($theme_id, $year, $month, $select_fields, 0, 21);
        $this->_viewVar['box_list'] = $box_list;
        $this->_viewVar['body_attr'] = ' class="past"';
        $this->load_view();
    }

    /**
     * ajax 获取盒子介绍
     */
    public function ajaxGetBoxIntroduction()
    {
        if ('post' == $this->input->method()) {
            $this->load->helper('http');
            $box_id = (int)$this->input->post('id');
            if (empty($box_id)) {
                http_ajax_response(1, '非法请求', []);
                return;
            }
            $this->load->model('box_model');
            $this->box_model->setSelectFields('id,theme_id,introduction_title,introduction_image');
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
}
