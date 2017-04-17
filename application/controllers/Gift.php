<?php

class Gift extends Home_Controller
{
    /**
     * index 订购礼物
     *
     */
    public function index()
    {
        $this->load->model('box_model');
        $year = date('Y', strtotime('-1 month'));
        $month = date('n', strtotime('-1 month'));
        $this->_viewVar['gift_list'] = $this->box_model->readBox(0, $year, $month);
        $this->load_view();
    }
}
