<?php

class Product extends Home_Controller
{
    /**
     * 订阅妹子页面
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

    public function all($tag_type = 'all')
    {
        $this->load->model('box_model');
        $tag_list = $this->box_model->readTagList();
        $this->_viewVar['tag_list'] = $tag_list;
        $this->_viewVar['body_attr'] = ' class="all-crates"';
        if (! empty($tag_list) && in_array(urldecode($tag_type), $tag_list)) {
            $conditions['AND']['tag'] = urldecode($tag_type);
            $this->_viewVar['box_list'] = $this->box_model->readBox(0, 0, 0, '*', 0, 100, '', $conditions);
        } elseif ($tag_type == 'month') {
            $year = date('Y', strtotime('-1 month'));
            $month = date('n', strtotime('-1 month'));
            $this->_viewVar['box_list'] = $this->box_model->readBox(0, $year, $month);
        } else {
            $this->_viewVar['box_list'] = $this->box_model->readBox();

        }
        $this->_viewVar['tag_type'] = $tag_type;
        $this->load_view();
    }

    public function checkout()
    {
        if (empty(intval($_GET['id'])) || empty(intval(intval($_GET['plan'])))) {
            show_404();
        }
        $box_id = intval($_GET['id']);
        $plan = intval($_GET['plan']);
        $this->load->model('box_model');
        $this->box_model->setSelectFields('*');
        $box_info = $this->box_model->find($box_id);
        if (empty($box_info)) {
            show_404();
        }
        $this->_viewVar['box_info'] = $box_info;
        $this->_viewVar['plan'] = $plan;
        $this->_viewVar['t_shirt_size'] = '';
        if (1 == $plan) {
            $this->_viewVar['price'] = $box_info['monthly_price'];
        } elseif (3 == $plan) {
            $this->_viewVar['price'] = $box_info['quarterly_price'];
        } elseif (6 == $plan) {
            $this->_viewVar['price'] = $box_info['semiannually_price'];
        } elseif (12 == $plan) {
            $this->_viewVar['price'] = $box_info['annually_price'];
            // 临时方案
            $t_shirt_array = [
                "33"  => '男 - S',
                "34"  => '男 - M',
                "35"  => '男 - L',
                "36"  => '男 - XL',
                "37"  => '男 - 2XL',
                "38"  => '男 - 3XL',
                "348" => '男 - 4XL',
                "349" => '男 - 5XL',
                "39"  => '女 - S',
                "40"  => '女 - M',
                "41"  => '女 - L',
                "42"  => '女 - XL',
                "43"  => '女 - 2XL',
                "44"  => '女 - 3XL',
            ];
            $this->_viewVar['t_shirt_size'] = $t_shirt_array[$_GET['tsize']];
        } else {
            show_404();
        }

        $this->_viewVar['body_attr'] = ' id="checkouts-steps"';
        if (empty($this->_loginUser)) {
            $this->load_view('product/nologin_checkout.php');
        } else {
            $user_id = $this->_loginUser['id'];
            $this->load->model('user_model');
            $this->_viewVar['user_info'] = $this->user_model->setSelectFields('id,post_name,post_phone,post_addr')
                                                            ->find($user_id);
            $this->load_view('product/checkout.php');
        }
    }

    public function ajaxGetBoxInfo()
    {
        if ('post' == $this->input->method()) {
            $this->load->helper('http');
            $box_id = (int)$this->input->post('id');
            if (empty($box_id)) {
                http_ajax_response(1, '非法请求', []);
                return;
            }
            $this->load->model('box_model');
            $this->box_model->setSelectFields('*');
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
