<?php

/**
 * Class Home_Controller
 */
class Home_Controller extends MY_Controller
{
    /**
     * Home_Controller constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
        // 渲染菜单
        $menu_list = $this->menu_model
            ->setConditions(['AND'=>['status'=>0],'ORDER'=>'list_order desc'])
            ->setSelectFields('id,name,url')
            ->read();
        $this->_viewVar['header_menu_list'] = $menu_list;

        // 检测登陆
        if (! empty($this->session->home_login_user)) {
            $this->_loginUser = $this->session->home_login_user;
        }
    }

    /**
     * load_view 加载模板
     *
     * @param string $view 模板名称,默认取与调用此方法的方法同名的视图
     * @param array  $var 分配给模板的变量,会和类变量$_viewVar合并
     */
    protected function load_view($view = '', $var = [])
    {
        // 分配给视图方法名
        if(empty($this->_headerViewVar['method_name'])) {
            $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
            $this->_headerViewVar['method_name'] = $backtrace[1]['function'];
        }
        // 获取默认视图,默认取与调用此方法的方法同名的视图
        if(empty($view)) {
            empty($backtrace) && $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
            $view = $this->_className . '/' .$backtrace[1]['function'];
        }
        // 将分配给_viewVar的视图数据和传入的视图数据合并,如果有相同键名则覆盖_viewVar的键值
        $var = array_merge($this->_headerViewVar, $this->_viewVar, $var);
        // 加载视图并分配视图变量
        $this->load->view('home/public/header', $var);
        $this->load->view('home/' . $view);
        $this->load->view('home/public/footer');
    }

    /**
     * checkLogin 检查用户登录状态,未登录跳转到首页,或指定URL
     */
    protected function checkLogin($redirect = '/')
    {
        if (! $this->is_login()) {
            redirect(base_url($redirect));
        }
    }

    /**
     * set_user_login
     * 设置用户登录信息
     *
     * @param int $user_id             用户id
     * @param string $user_login_email 用户登录邮箱
     *
     */
    protected function set_user_login($user_id, $user_login_email)
    {
        $this->session->home_login_user = [
            'id'          => $user_id,
            'login_email' => $user_login_email,
        ];
    }
}
