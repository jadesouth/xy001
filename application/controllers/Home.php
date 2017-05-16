<?php

class Home extends Home_Controller
{
    /**
     * index 网站首页
     *
     */
    public function index()
    {
        $this->load->model('box_model');
        $box_list = $this->box_model->getHomePageBoxInfo();
        $this->_viewVar['box_list'] = $box_list;
        $this->_viewVar['body_attr'] = ' id="homepage-index" class="homepage homepage is-mobile"';
        $this->load_view();
    }
}
