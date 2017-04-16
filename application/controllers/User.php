<?php

class User extends Home_Controller
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        if (! in_array($this->router->method, ['ajax_register', 'ajax_login']) && empty($this->_loginUser)) {
            redirect('/');
        }
    }

    /**
     * ajax_register
     * 用户注册
     *
     */
    public function ajax_register()
    {
        $this->load->library('form_validation');
        if (false === $this->form_validation->run()) {
            http_ajax_response(1, $this->form_validation->error_string());
        } else {
            $user_info['login_email'] = $this->input->post('email', true);
            $user_info['password'] = $this->input->post('password', true);
            $user_id = $this->_model->add_user($user_info);
            if (! empty($user_id)) {
                http_ajax_response(0, '注册成功');
                $this->set_user_login($user_id, $user_info['login_email']);
                return;
            }
            http_ajax_response(1, '注册失败');
        }
    }

    /**
     * 修改姓名
     */
    public function ajax_edit_name()
    {
        $this->load->library('form_validation');
        if (false === $this->form_validation->run()) {
            http_ajax_response(1, $this->form_validation->error_string());
        } else {
            $user_id = $this->_loginUser['id'];
            $update_data['name'] = $this->input->post('name', true);
            $return = $this->_model->modify($user_id, $update_data);
            if (! empty($return)) {
                http_ajax_response(0, '修改成功');
                return;
            }
            http_ajax_response(1, '修改失败');
        }

    }

    /**
     * 修改邮箱
     */
    public function ajax_edit_email()
    {
        $this->load->library('form_validation');
        if (false === $this->form_validation->run()) {
            http_ajax_response(1, $this->form_validation->error_string());
        } else {
            $user_id = $this->_loginUser['id'];
            $update_data['login_email'] = $this->input->post('email', true);
            $return = $this->_model->modify($user_id, $update_data);
            if (! empty($return)) {
                http_ajax_response(0, '修改成功');
                $this->set_user_login($user_id, $update_data['login_email']);
                return;
            }
            http_ajax_response(1, '修改失败');
        }
    }

    /**
     * 修改密码
     */
    public function ajax_edit_password()
    {
        $this->load->library('form_validation');
        if (false === $this->form_validation->run()) {
            http_ajax_response(1, $this->form_validation->error_string());
        } else {
            $user_id = $this->_loginUser['id'];
            $old_password = $this->input->post('user_current_password', true);
            $new_password = $this->input->post('user_password', true);
            $user_info = $this->_model->setConditions(['id' => $user_id])->setSelectFields('password, salt')->get();
            if (empty($user_info)) {
                http_ajax_response(1, '登录账号不存在');
                return;
            }
            $this->load->helper('security');
            if ($user_info['password'] !== generate_admin_password($old_password, $user_info['salt'])) {
                http_ajax_response(1, '原密码错误,请重新输入');
                return;
            }
            $this->load->helper(['tools', 'security']);
            $update_data['salt'] = random_characters();
            $update_data['password'] = generate_admin_password($new_password, $update_data['salt']);
            $return = $this->_model->modify($user_id, $update_data);
            if (! empty($return)) {
                http_ajax_response(0, '修改成功');
                return;
            }
            http_ajax_response(1, '修改失败');
        }
    }

    /**
     * ajax_login
     * 用户登录
     *
     */
    public function ajax_login()
    {
        $this->load->library('form_validation');
        if (false === $this->form_validation->run()) {
            http_ajax_response(1, $this->form_validation->error_string());
        } else {
            $login_email = $this->input->post('email', true);;
            $password = $this->input->post('password', true);
            $this->_model->setConditions(['login_email' => $login_email, 'status' => 0]);
            $this->_model->setSelectFields('id,login_email,password,salt');
            $user_info = $this->_model->get();
            if (empty($user_info)) {
                http_ajax_response(1, '您的邮箱未注册');
                return;
            }
            $this->load->helper('security');
            if ($user_info['password'] !== generate_admin_password($password, $user_info['salt'])) {
                http_ajax_response(1, '登录密码错误');
                return;
            }
            http_ajax_response(0, '登录成功');
            $this->set_user_login($user_info['id'], $user_info['login_email']);
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
    private function set_user_login($user_id, $user_login_email)
    {
        $this->session->home_login_user = [
            'id'          => $user_id,
            'login_email' => $user_login_email,
        ];
    }

    /**
     * logout 退出账号
     *
     */
    public function logout()
    {
        $this->session->unset_userdata('home_login_user');
        redirect('/');
    }
}