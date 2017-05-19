<?php
/**
 * Class Vote 投票控制器
 */
class Vote extends Admin_Controller
{
    /**
     * index 获取投票列表(分页)数据控制器
     * @param int $page 分页页码
     */
    public function index($page = 0)
    {
        // 分页页码
        $page = 0 >= $page ? 1 : $page;

        // view data
        $this->_headerViewVar['h1_title'] = '投票项列表';
        $this->_headerViewVar['method_name'] = __FUNCTION__;
        $this->_viewVar['table_header'] = ['#', '图片', '投票内容', '票数', '操作'];

        // model
        $this->load->model('vote_model');

        // 获取记录总条数
        $count = $this->vote_model->count();
        if(! empty($count)) {
            // Page configure
            $this->load->library('pagination');
            $config['base_url'] = base_url("admin/vote");
            $config['total_rows'] = (int)$count;
            $this->pagination->initialize($config);
            $this->_viewVar['page'] = $this->pagination->create_links();
            // get page data
            $this->_viewVar['data'] = $this->vote_model
                ->setSelectFields('id,image,content,count,status')
                ->getPage($page, ADMIN_PAGE_SIZE);
        }

        // 加载视图
        $this->load_view();
    }

    /**
     * setShow 设置投票显示
     */
    public function setShow()
    {
        $this->load->helper('http');
        $vote_id = (int)$this->input->post('vote', 0);
        if (0 >= $vote_id) {
            http_ajax_response(1, '非法请求');
            return;
        }

        $this->load->model('vote_model');
        if (true == $this->vote_model->modify($vote_id, ['status' => 0])) {
            http_ajax_response(0, '设置成功');
        } else {
            http_ajax_response(2, '设置失败');
        }
    }

    /**
     * setNotShow 设置投票不显示
     */
    public function setNotShow()
    {
        $this->load->helper('http');
        $vote_id = (int)$this->input->post('vote', 0);
        if (0 >= $vote_id) {
            http_ajax_response(1, '非法请求');
            return;
        }

        $this->load->model('vote_model');
        if (true == $this->vote_model->modify($vote_id, ['status' => 1])) {
            http_ajax_response(0, '设置成功');
        } else {
            http_ajax_response(2, '设置失败');
        }
    }
}