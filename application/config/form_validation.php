<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 表单验证匹配规则配置文件
 *
 * @author wangnan <wangnanphp@163.com>
 * @date   2016-11-13 20:17:30
 */
$config = [
    // 配置错误定界符
    'error_prefix' => '<p class="text-danger">',
    'error_suffix' => '</p>',
    // 管理管理员相关
    'admin/manager/login' => [ // 管理员登陆
        ['field' => 'login_name', 'label' => '用户名', 'rules' => 'trim|required|min_length[4]|max_length[18]'],
        ['field' => 'password', 'label' => '密码', 'rules' => 'trim|required|min_length[6]|max_length[18]'],
    ],
    // 主题相关
    'admin/theme/add' => [ // 添加主题
        ['field' => 'name', 'label' => '主题名称', 'rules' => 'trim|required|min_length[4]|max_length[18]|is_unique[theme.name]'],
    ],
    'admin/keywords/add' => [ // 添加关键字
        ['field' => 'type', 'label' => '关键字类型', 'rules' => 'trim|required|in_list[1,2,3,4]'],
        ['field' => 'word', 'label' => '关键字', 'rules' => 'trim|required'],
    ],
    'admin/keywords/search' => [ // 搜索关键字
        ['field' => 'type', 'label' => '关键字类型', 'rules' => 'trim|required|in_list[1,2,3,4]'],
        ['field' => 'word', 'label' => '关键字', 'rules' => 'trim|required'],
    ],
    'admin/banner/add' => [ // 添加 Banner
        ['field' => 'banner', 'label' => 'Banner 图片', 'rules' => 'trim|required'],
    ],
    'admin/banner/delete' => [ // 删除 Banner
        ['field' => 'banner', 'label' => 'Banner 图片', 'rules' => 'trim|required'],
    ],
    'keywords/addAddress' => [ // 添加地址关键字
        ['field' => 'province', 'label' => '省份', 'rules' => 'trim|required'],
        ['field' => 'city', 'label' => '市区', 'rules' => 'trim|required'],
        ['field' => 'county', 'label' => '县城', 'rules' => 'trim|required'],
        ['field' => 'address', 'label' => '详细地址', 'rules' => 'trim|required'],
    ],
    'keywords/advertising' => [ // 广告法关键字查询
        ['field' => 'contents', 'label' => '内容', 'rules' => 'trim|required'],
    ],
    'keywords/address' => [ // 地址关键字查询
        ['field' => 'province', 'label' => '省份', 'rules' => 'trim|required'],
        ['field' => 'city', 'label' => '市', 'rules' => 'trim|required'],
        ['field' => 'county', 'label' => '区/县', 'rules' => 'trim|required'],
        ['field' => 'address', 'label' => '详细地址', 'rules' => 'trim|required'],
    ],
    'keywords/apply' => [ // 关键字查询申请
        ['field' => 'phone', 'label' => '手机号码', 'rules' => 'trim|required|is_natural_no_zero|integer'],
        ['field' => 'email', 'label' => '电子邮件', 'rules' => 'trim|required|valid_email'],
        ['field' => 'qq', 'label' => 'QQ号码', 'rules' => 'trim|required|is_natural_no_zero|integer|greater_than_equal_to[10000]'],
    ],
    'user/ajax_register' => [ // 用户注册
        ['field' => 'login_name', 'label' => '登录名', 'rules'=> 'trim|required|is_unique[user.login_name]'],
        ['field' => 'password', 'label' => '密码', 'rules'=> 'trim|required'],
        ['field' => 'con_password', 'label' => '确认密码', 'rules'=> 'trim|required|matches[password]'],
    ],
    'user/ajax_login' => [ // 用户注册
        ['field' => 'login_name', 'label' => '登录名', 'rules'=> 'trim|required'],
        ['field' => 'password', 'label' => '密码', 'rules'=> 'trim|required'],
    ],
    'user/detail' => [ // 个人设置
        ['field' => 'real_name', 'label' => '真实姓名', 'rules'=> 'trim'],
        ['field' => 'sex', 'label' => '性别', 'rules'=> 'trim|in_list[1,2]'],
        ['field' => 'phone', 'label' => '手机', 'rules'=> 'trim|integer'],
        ['field' => 'email', 'label' => '邮箱', 'rules'=> 'trim|valid_email'],
        ['field' => 'qq', 'label' => 'QQ', 'rules'=> 'trim|integer|min_length[6]|max_length[11]'],
        ['field' => 'idcard', 'label' => '身份证', 'rules'=> 'trim|min_length[16]|max_length[18]'],
    ],
    'user/change_password' => [ // 修改密码
        ['field' => 'old_password', 'label' => '当前密码', 'rules'=> 'trim|required'],
        ['field' => 'new_password', 'label' => '新密码', 'rules'=> 'trim|required'],
        ['field' => 'con_new_password', 'label' => '重复输入新密码', 'rules'=> 'trim|required|matches[new_password]'],
    ],
];
