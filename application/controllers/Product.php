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

    public function all($tag_type='all')
    {
        $this->load->model('box_model');
        $tag_list = $this->box_model->readTagList();
        $this->_viewVar['tag_list'] = $tag_list;
        $this->_viewVar['body_attr'] = ' class="all-crates"';
        if(!empty($tag_list) && in_array(urldecode($tag_type),$tag_list)){
            $conditions['AND']['tag'] = urldecode($tag_type);
            $this->_viewVar['box_list'] = $this->box_model->readBox(0, 0, 0,'*',0,100,'',$conditions);
        }elseif($tag_type == 'month'){
            $year = date('Y', strtotime('-1 month'));
            $month = date('n', strtotime('-1 month'));
            $this->_viewVar['box_list'] = $this->box_model->readBox(0, $year, $month);
        }else{
            $this->_viewVar['box_list'] = $this->box_model->readBox();

        }
        $this->_viewVar['tag_type'] = $tag_type;
        $this->load_view();
    }
}
