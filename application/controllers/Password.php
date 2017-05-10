<?php

/**
 * Class Password
 */
class Password extends Home_Controller
{
    /**
     * index 网站首页
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
                $this->user_model->setSelectFields('id,login_email,name,password,salt');
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
                $config['crlf']="\r\n";
                $config['newline']="\r\n";
                $config['protocol'] = 'smtp';
                $config['smtp_host'] = 'smtp.exmail.qq.com';
                $config['smtp_user'] = 'weloveyou@amazingfun.cn';
                $config['smtp_pass'] = 'Amazing123';
                $config['smtp_port'] = '25';
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = true;
                $config['mailtype'] = 'html';
                $this->email->initialize($config);

                $this->email->from('weloveyou@amazingfun.cn', 'AmazingFun');
                $this->email->to($email);

                $this->email->subject('AmazingFun-找回密码');
                $user_name = empty($user_info['name']) ? '': ($user_info['name'].',');
                $message = "<div class=\"\" style=\"display:block;padding:0;margin:0;height:100%;max-height:none;min-height:none;line-height:normal;overflow:visible;\">
    <span style=\"font-family: 'proxima_nova_rgregular', Helvetica; font-weight: normal;\">
" .$user_name. "你好 :<br><br>
        您最近提出了重设 AmazingFun ID 密码的请求。要完成此过程，请点按下方链接。

        <br/><br/>
        <a target=\"_blank\" href=\"" .$find_pwd_url. "\">立即重设</a>
        <br/><br/>
        如果您未做过此更改并认为有人未经授权访问了您的帐户，您应尽快前往 <a target=\"_blank\" href=\"http://www.amazingfun.cn\">www.amazingfun.cn</a> 重设您的密码。
        <br><br>
AmazinFun 团队,
        <br><br>
    </span>
</div>";
                $this->email->message($message);

                $return = $this->email->send(false);
                if($return){
                    http_ajax_response(0, '邮件已经发送至您的邮箱！');
                    return;
                }
                http_ajax_response(1,'邮件发送失败,请稍后再试');

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
