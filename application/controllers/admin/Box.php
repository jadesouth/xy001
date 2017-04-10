<?php

class Box extends Admin_Controller
{
    /**
     * index 获取盒子(分页)数据控制器
     *
     * @param int $page 分页页码
     *
     */
    public function index($page = 0)
    {
        // 分页页码
        $page = 0 >= $page ? 1 : $page;

        // view data
        $this->_headerViewVar['h1_title'] = '盒子列表';
        $this->_headerViewVar['method_name'] = __FUNCTION__;
        $this->_viewVar['table_header'] = ['#', '名称', '主题', '年', '月', '操作'];

        // model
        $this->load->model('box_model');
        // 获取记录总条数
        $count = $this->box_model->count();
        if (! empty($count)) {
            // Page configure
            $this->load->library('pagination');
            $config['base_url'] = base_url("admin/".$this->_className."/index");
            $config['total_rows'] = (int)$count;
            $this->pagination->initialize($config);
            $this->_viewVar['page'] = $this->pagination->create_links();
            // get page data
            $this->_viewVar['data'] = $this->box_model
                ->setSelectFields('id,name,theme_name,year,month')
                ->getPage($page, ADMIN_PAGE_SIZE);
        }

        // 加载视图
        $this->load_view();
    }

    private function _get_format_form_data(){
        $this->load->helper('http');
        $theme = explode('-',$this->input->post('theme'));
        return [
            'name' => $this->input->post('name'),
            'theme_id' => $theme[0],
            'theme_name' => $theme[1],
            'year' => $this->input->post('year'),
            'month' => $this->input->post('month'),
            'monthly_price' => $this->input->post('monthly_price'),
            'quarterly_price' => $this->input->post('quarterly_price'),
            'semiannually_price' => $this->input->post('semiannually_price'),
            'annually_price' => $this->input->post('annually_price'),
            'cover_title' => $this->input->post('cover_title'),
            'cover_subtitle' => $this->input->post('cover_subtitle'),
            'cover_image' => $this->input->post('cover_image_url'),
            'introduction_title' => $this->input->post('introduction_title'),
            'introduction_image' => $this->input->post('introduction_image_url'),
            'gift_introduction' => $this->input->post('gift_introduction'),
            'gift_image' => $this->input->post('gift_image_url'),
            'bannber_image1' => $this->input->post('bannber_image1_url'),
            'bannber_image2' => $this->input->post('bannber_image2_url'),
            'bannber_image3' => $this->input->post('bannber_image3_url'),
            'bannber_image4' => $this->input->post('bannber_image4_url'),
            'bannber_title1' => $this->input->post('bannber_title1'),
            'bannber_title2' => $this->input->post('bannber_title2'),
            'bannber_title3' => $this->input->post('bannber_title3'),
            'bannber_title4' => $this->input->post('bannber_title4'),
            'image1' => $this->input->post('image1_url'),
            'image2' => $this->input->post('image2_url'),
            'image3' => $this->input->post('image3_url'),
            'image4' => $this->input->post('image4_url'),
            'characteristic' => $this->input->post('characteristic'),
            'logistics' => $this->input->post('logistics'),
            'about' => $this->input->post('about'),
        ];
    }
    /**
     * add 添加盒子
     */
    public function add(){
        $this->load->model('box_model');
        if('post' == $this->input->method()){
            $this->load->library('form_validation');
            if(false === $this->form_validation->run()) {
                http_ajax_response(1, $this->form_validation->error_string());
                return;
            }
            $insert_data = $this->_get_format_form_data();
            $insert_result = $this->box_model->setInsertData($insert_data)->create();
            if(!empty($insert_result)){
                http_ajax_response(0,'添加盒子成功',[]);
                return;
            }
            http_ajax_response(1,'添加盒子失败',[]);
            return;
        }
        // view data
        $this->_headerViewVar['h1_title'] = '添加盒子';
        $this->_headerViewVar['method_name'] = __FUNCTION__;
        $this->load->model('box_model');
        $theme_data = $this->box_model
            ->setTable('theme')
            ->setSelectFields('id,name')
            ->read();
        if (empty($theme_data)) {
            redirect('admin/theme/');
        }

        $this->_viewVar['theme_data'] = $theme_data;
        // 加载视图
        $this->load_view();
    }

    /**
     * edit 编辑盒子
     */
    public function edit($box_id = 0){
        $this->load->model('box_model');
        if('post' == $this->input->method()){
            $this->load->library('form_validation');
            if(false === $this->form_validation->run()) {
                http_ajax_response(1, $this->form_validation->error_string());
                return;
            }
            $update_info = $this->_get_format_form_data();
            $this->box_model->setUpdateData($update_info);
            $insert_result = $this->box_model->modify($box_id);
            if(!empty($insert_result)){
                http_ajax_response(0,'编辑盒子成功',[]);
                return;
            }
            http_ajax_response(1,'编辑盒子失败',[]);
            return;
        }
        // view data
        $this->_headerViewVar['h1_title'] = '编辑盒子';
        $this->_headerViewVar['method_name'] = __FUNCTION__;
        $theme_data = $this->box_model
            ->setTable('theme')
            ->setSelectFields('id,name')
            ->read();
        if (empty($theme_data)) {
            redirect('admin/theme/');
        }
        $box_info = $this->box_model->setTable('box')->setSelectFields('*')->find($box_id);
        if(empty($box_info)){
            redirect('admin/box/');
        }
        $this->_viewVar['theme_data'] = $theme_data;
        $this->_viewVar['data'] = $box_info;
        // 加载视图
        $this->load_view();
    }

    /**
     * detail 盒子详情
     *
     * @param int $box_id
     */
    public function detail($box_id = 0)
    {
        if (0 >= $box_id) {
            redirect('admin/box/');
        }
        // view data
        $this->_headerViewVar['h1_title'] = '盒子详情';
        $this->_headerViewVar['method_name'] = __FUNCTION__;

        // 获取用户信息
        $this->load->model('box_model');
        $box_info = $this->box_model
            ->setSelectFields('*')
            ->find($box_id);
        if (empty($box_info)) {
            redirect('admin/box/');
        }

        $this->_viewVar['data'] = $box_info;
        $this->load_view();
    }
}