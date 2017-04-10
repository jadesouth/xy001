<?php

class Home extends Home_Controller
{
    /**
     * index 网站首页
     *
     */
    public function index()
    {
        $this->_headerViewVar['title'] = '首页';
        $this->load_view();
    }
}
