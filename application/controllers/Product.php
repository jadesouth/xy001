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
        $this->load->model('box_model');
        $box_id = (int)$this->input->get('id');
        $theme_id = (int)$this->input->get('theme_id');
        if (empty($box_id)) {
            $box_id = $this->box_model->getLastBoxId($theme_id);
        }
        $this->box_model->setSelectFields('*');
        $box_info = $this->box_model->find($box_id);
        $this->_viewVar['box_info'] = $box_info;
        $this->load_view();
    }
}
