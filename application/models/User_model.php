<?php

/**
 * Class User_model 用户模型
 */
class User_model extends MY_Model
{
    /**
     * add 添加用户,同时添加user和user_profile表数据
     *
     * @param array $user_info 用户信息
     *
     * @return bool
     */
    public function add_user($user_info)
    {
        if (empty($user_info['login_email']) || empty($user_info['password'])) {
            return false;
        }
        $this->load->helper(['tools', 'security']);
        $insert_data['login_email'] = $user_info['login_email'];
        $insert_data['salt'] = random_characters();
        $insert_data['password'] = generate_admin_password($user_info['password'], $insert_data['salt']);
        $insert_data['status'] = 0;
        $user_id = $this->create($insert_data);
        return $user_id;
    }
}
