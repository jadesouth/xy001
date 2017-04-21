<?php
/**
 * Class Show_Wall 图片墙控制器
 */
class Show_wall extends Admin_Controller
{
    /**
     * index 获取图片墙列表(分页)数据控制器
     * @param int $page 分页页码
     */
    public function index($page = 0)
    {
        // 分页页码
        $page = 0 >= $page ? 1 : $page;

        // view data
        $this->_headerViewVar['h1_title'] = '展示墙列表';
        $this->_headerViewVar['method_name'] = __FUNCTION__;
        $this->_viewVar['table_header'] = ['#', '封面图片', '链接地址', '类型', '添加时间', '操作'];

        // model
        $this->load->model('show_wall_model');

        // 获取记录总条数
        $count = $this->show_wall_model->count();
        if(! empty($count)) {
            // Page configure
            $this->load->library('pagination');
            $config['base_url'] = base_url("show_wall/index");
            $config['total_rows'] = (int)$count;
            $this->pagination->initialize($config);
            $this->_viewVar['page'] = $this->pagination->create_links();
            // get page data
            $this->_viewVar['data'] = $this->show_wall_model
                ->setSelectFields('id,image,url,type,created_at')
                ->getPage($page, ADMIN_PAGE_SIZE);
        }

        // 加载视图
        $this->load_view();
    }
}