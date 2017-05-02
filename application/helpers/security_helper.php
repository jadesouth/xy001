<?php

/**
 * Security_helper.php 安全函数帮助文件
 */

if ( ! function_exists('generate_home_password')) {
    /**
     * generate_home_password 生成前台密码
     *
     * @param string $password 原始密码
     * @param string $salt 加密盐值
     *
     * @return string 生成的密码字符串
     */
    function generate_home_password($password, $salt)
    {
        if(empty($password) || empty($salt)) {
            return false;
        }

        return md5(md5($password) . md5($salt));
    }
}

if ( ! function_exists('generate_admin_password')) {
    /**
     * generate_admin_password 生成后台密码
     *
     * @param string $password 原始密码
     * @param string $salt 加密盐值
     *
     * @return string 生成的密码字符串
     */
    function generate_admin_password($password, $salt)
    {
        if(empty($password) || empty($salt)) {
            return false;
        }

        return md5(md5($password) . $salt);
    }
}
