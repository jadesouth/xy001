<?php

class Password extends Home_Controller
{
    /**
     * index 网站首页
     *
     */
    public function index()
    {
        $this->load_view();
    }

    public function ajaxFindPwd()
    {
        $this->load->helper('http');
        $this->load->library('form_validation');
        if ('post' == $this->input->method()) {
            if (false === $this->form_validation->run()) {
                http_ajax_response(1, $this->form_validation->error_string());
                return;
            } else {
                $email = $this->input->post('email', true);
                $this->load->model('user_model');
                $this->user_model->setConditions(['login_email' => $email, 'status' => 0]);
                $this->user_model->setSelectFields('id,login_email,password,salt');
                $user_info = $this->user_model->get();
                if (empty($user_info)) {
                    http_ajax_response(1, '您的邮箱未注册');
                    return;
                }
                $timestamp = time();
                $token = md5(md5($email) . md5($user_info['password']) . $timestamp);
                $find_pwd_url = base_url('password/find') . '?email=' . $email . '&token=' . $token . '&time=' . $timestamp;
                $this->load->library('email');

                //以下设置Email参数
                $config['protocol'] = 'smtp';
                $config['smtp_host'] = 'smtp.163.com';
                $config['smtp_user'] = 'wangnanphp@163.com';
                $config['smtp_pass'] = 'mail.php.wangnan';
                $config['smtp_port'] = '25';
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = true;
                $config['mailtype'] = 'html';
                $this->email->initialize($config);

                $this->email->from('wangnanphp@163.com', 'WN');
                $this->email->to($email);

                $this->email->subject('AmazingFun-找回密码');
                $this->email->message($find_pwd_url);

                $this->email->send(false);
                http_ajax_response(0, '邮件已经发送至您的邮箱！');
                return;
            }
        }
        http_ajax_response(1, '非法请求', []);
    }

    public function find()
    {
        if (empty($_GET['email']) || empty($_GET['token']) || empty($_GET['time'])) {
            echo '参数不全';
            return;
        }
        $email = $_GET['email'];
        $timestamp = $_GET['time'];
        $token = $_GET['token'];
        $this->load->model('user_model');
        $this->user_model->setConditions(['login_email' => $email, 'status' => 0]);
        $this->user_model->setSelectFields('id,login_email,password,salt');
        $user_info = $this->user_model->get();
        if (empty($user_info)) {
            echo '您的邮箱未注册';
            return;
        }
        $check_token = md5(md5($email) . md5($user_info['password']) . $timestamp);
        if ($check_token != $token) {
            echo '非法请求';
            return;
        }
        if (time() - $timestamp >= 300) {
            echo '时间已经超过10分钟';
            return;
        }

        $this->load->helper('http');
        $this->load->library('form_validation');
        if ('post' == $this->input->method()) {
            if (false === $this->form_validation->run()) {
                http_ajax_response(1, $this->form_validation->error_string());
                return;
            } else {
                //修改用户密码
                $new_password = $this->input->post('password', true);
                $this->load->helper(['tools', 'security']);
                $update_data['salt'] = random_characters();
                $update_data['password'] = generate_admin_password($new_password, $update_data['salt']);
                $this->user_model->setConditions(['login_email' => $email, 'status' => 0]);
                $return = $this->user_model->update($update_data);
                if (! empty($return)) {
                    http_ajax_response(0, '修改成功,请重新登录');
                    return;
                }
                http_ajax_response(1, '修改失败');
            }
        } else {
            $this->_viewVar['body_attr'] = ' id="pwreset-steps"';
            $this->_viewVar['url'] = "/password/find?email=$email&token=$token&time=$timestamp";
            $this->load_view();
        }
    }
}



