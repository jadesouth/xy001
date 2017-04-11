<?php

class Product extends Home_Controller
{
    /**
     * 订阅妹子页面
     *
     */
    public function index()
    {
        $this->load->helper('http');
        $box_id = (int)$this->input->get('id');
        if (empty($box_id)) {
            show_404();
        }
        $this->load->model('box_model');
        $this->box_model->setSelectFields('*');
        $box_info = $this->box_model->find($box_id);
        $this->_viewVar['box_info'] = $box_info;
        $this->load_view();
    }
}
