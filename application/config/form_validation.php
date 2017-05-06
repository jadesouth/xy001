<?php

/**
 * 表单验证匹配规则配置文件
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
    'admin/admin/add' => [ // 添加管理员
        ['field' => 'login_name', 'label' => '登录账号', 'rules' => 'trim|required|min_length[4]|max_length[18]|is_unique[admin.login_name]'],
        ['field' => 'password', 'label' => '登录密码', 'rules' => 'trim|required|min_length[6]|max_length[18]'],
    ],
    'admin/admin/edit' => [ // 编辑管理员
        ['field' => 'id', 'label' => '登录密码', 'rules' => 'trim|required|integer'],
        ['field' => 'password', 'label' => '登录密码', 'rules' => 'trim|min_length[6]|max_length[18]'],
        ['field' => 'lock', 'label' => '是否禁用', 'rules' => 'trim|in_list[0,1]'],
    ],
    // 主题相关
    'admin/theme/add' => [ // 添加主题
        ['field' => 'name', 'label' => '主题名称', 'rules' => 'trim|required|min_length[4]|max_length[18]|is_unique[theme.name]'],
    ],
    // 菜单相关
    'admin/menu/add' => [ // 添加菜单
        ['field' => 'name', 'label' => '菜单名称', 'rules' => 'trim|required|min_length[1]|max_length[18]|is_unique[menu.name]'],
        ['field' => 'url', 'label' => '链接地址', 'rules' => 'trim|required|valid_url|is_unique[menu.url]'],
        ['field' => 'list_order', 'label' => '排序', 'rules' => 'trim|is_natural'],
    ],
    'admin/menu/edit' => [ // 添加菜单
        ['field' => 'name', 'label' => '菜单名称', 'rules' => 'trim|required|min_length[1]|max_length[18]'],
        ['field' => 'url', 'label' => '链接地址', 'rules' => 'trim|required|valid_url'],
        ['field' => 'list_order', 'label' => '排序', 'rules' => 'trim|is_natural'],
    ],
    // 展示墙相关
    'admin/show_wall/add' => [ // 添加展示墙
        ['field' => 'image', 'label' => '展示墙封面图', 'rules' => 'trim|required'],
        ['field' => 'url', 'label' => '链接地址', 'rules' => 'trim|required'],
        ['field' => 'type', 'label' => '展示墙类型', 'rules' => 'trim|required|is_natural'],
    ],
    // 盒子相关
    'box/add' => [ // 添加盒子
        ['field' => 'name', 'label' => '盒子名称', 'rules' => 'trim|required'],
        ['field' => 'theme', 'label' => '主题', 'rules' => 'trim|required'],
        ['field' => 'year', 'label' => '年', 'rules' => 'trim|integer|exact_length[4]|required'],
        ['field' => 'month', 'label' => '月', 'rules' => 'trim|integer|min_length[1]|required'],
        ['field' => 'monthly_price', 'label' => '价格/月', 'rules' => 'trim|required'],
        ['field' => 'quarterly_price', 'label' => '价格/3月', 'rules' => 'trim|required'],
        ['field' => 'semiannually_price', 'label' => '价格／6月', 'rules' => 'trim|required'],
        ['field' => 'annually_price', 'label' => '价格／12月', 'rules' => 'trim|required'],
        ['field' => 'cover_title', 'label' => '封面标题', 'rules' => 'trim|required'],
        ['field' => 'cover_subtitle', 'label' => '封面副标题', 'rules' => 'trim|required'],
        ['field' => 'cover_image_url', 'label' => '封面图片', 'rules' => 'trim|required|valid_url'],
        ['field' => 'introduction_title', 'label' => '介绍', 'rules' => 'trim|required'],
        ['field' => 'introduction_image_url', 'label' => '介绍图片', 'rules' => 'trim|required|valid_url'],
        ['field' => 'gift_introduction', 'label' => '礼物封面介绍', 'rules' => 'trim|required'],
        ['field' => 'gift_image_url', 'label' => '礼物封面', 'rules' => 'trim|required|valid_url'],
        ['field' => 'banner_image1_url', 'label' => '轮播图1', 'rules' => 'trim|required|valid_url'],
        ['field' => 'banner_image2_url', 'label' => '轮播图2', 'rules' => 'trim|required|valid_url'],
        ['field' => 'banner_image3_url', 'label' => '轮播图3', 'rules' => 'trim|required|valid_url'],
        ['field' => 'banner_image4_url', 'label' => '轮播图4', 'rules' => 'trim|required|valid_url'],
        ['field' => 'banner_title1', 'label' => '轮播图标题1', 'rules' => 'trim|required'],
        ['field' => 'banner_title2', 'label' => '轮播图标题2', 'rules' => 'trim|required'],
        ['field' => 'banner_title3', 'label' => '轮播图标题3', 'rules' => 'trim|required'],
        ['field' => 'banner_title4', 'label' => '轮播图标题4', 'rules' => 'trim|required'],
        ['field' => 'image1_url', 'label' => '物品图1', 'rules' => 'trim|required|valid_url'],
        ['field' => 'image2_url', 'label' => '物品图2', 'rules' => 'trim|required|valid_url'],
        ['field' => 'image3_url', 'label' => '物品图3', 'rules' => 'trim|required|valid_url'],
        ['field' => 'image4_url', 'label' => '物品图4', 'rules' => 'trim|required|valid_url'],
        ['field' => 'characteristic', 'label' => '特征', 'rules' => 'trim|required'],
        ['field' => 'logistics', 'label' => '送货', 'rules' => 'trim|required'],
        ['field' => 'about', 'label' => '关于主题', 'rules' => 'trim|required'],
    ],
    'box/edit' => [ // 编辑盒子
        ['field' => 'name', 'label' => '盒子名称', 'rules' => 'trim|required'],
        ['field' => 'theme', 'label' => '主题', 'rules' => 'trim|required'],
        ['field' => 'year', 'label' => '年', 'rules' => 'trim|integer|exact_length[4]|required'],
        ['field' => 'month', 'label' => '月', 'rules' => 'trim|integer|min_length[1]|required'],
        ['field' => 'monthly_price', 'label' => '价格/月', 'rules' => 'trim|required'],
        ['field' => 'quarterly_price', 'label' => '价格/3月', 'rules' => 'trim|required'],
        ['field' => 'semiannually_price', 'label' => '价格／6月', 'rules' => 'trim|required'],
        ['field' => 'annually_price', 'label' => '价格／12月', 'rules' => 'trim|required'],
        ['field' => 'cover_title', 'label' => '封面标题', 'rules' => 'trim|required'],
        ['field' => 'cover_subtitle', 'label' => '封面副标题', 'rules' => 'trim|required'],
        ['field' => 'cover_image_url', 'label' => '封面图片', 'rules' => 'trim|required|valid_url'],
        ['field' => 'introduction_title', 'label' => '介绍', 'rules' => 'trim|required'],
        ['field' => 'introduction_image_url', 'label' => '介绍图片', 'rules' => 'trim|required|valid_url'],
        ['field' => 'gift_introduction', 'label' => '礼物封面介绍', 'rules' => 'trim|required'],
        ['field' => 'gift_image_url', 'label' => '礼物封面', 'rules' => 'trim|required|valid_url'],
        ['field' => 'banner_image1_url', 'label' => '轮播图1', 'rules' => 'trim|required|valid_url'],
        ['field' => 'banner_image2_url', 'label' => '轮播图2', 'rules' => 'trim|required|valid_url'],
        ['field' => 'banner_image3_url', 'label' => '轮播图3', 'rules' => 'trim|required|valid_url'],
        ['field' => 'banner_image4_url', 'label' => '轮播图4', 'rules' => 'trim|required|valid_url'],
        ['field' => 'banner_title1', 'label' => '轮播图标题1', 'rules' => 'trim|required'],
        ['field' => 'banner_title2', 'label' => '轮播图标题2', 'rules' => 'trim|required'],
        ['field' => 'banner_title3', 'label' => '轮播图标题3', 'rules' => 'trim|required'],
        ['field' => 'banner_title4', 'label' => '轮播图标题4', 'rules' => 'trim|required'],
        ['field' => 'image1_url', 'label' => '物品图1', 'rules' => 'trim|required|valid_url'],
        ['field' => 'image2_url', 'label' => '物品图2', 'rules' => 'trim|required|valid_url'],
        ['field' => 'image3_url', 'label' => '物品图3', 'rules' => 'trim|required|valid_url'],
        ['field' => 'image4_url', 'label' => '物品图4', 'rules' => 'trim|required|valid_url'],
        ['field' => 'characteristic', 'label' => '特征', 'rules' => 'trim|required'],
        ['field' => 'logistics', 'label' => '送货', 'rules' => 'trim|required'],
        ['field' => 'about', 'label' => '关于主题', 'rules' => 'trim|required'],
    ],
    // 前台用户相关
    'user/ajax_register' => [ // 用户注册
        ['field' => 'email', 'label' => '邮箱', 'rules'=> 'trim|required|valid_email|is_unique[user.login_email]'],
        ['field' => 'password', 'label' => '密码', 'rules'=> 'trim|required'],
    ],
    'user/ajax_login' => [ // 用户登录
        ['field' => 'email', 'label' => '邮箱', 'rules'=> 'trim|required|valid_email'],
        ['field' => 'password', 'label' => '密码', 'rules'=> 'trim|required'],
    ],
    'user/ajax_edit_name' => [ // 用户编辑姓名
        ['field' => 'name', 'label' => '姓名', 'rules'=> 'trim|required'],
    ],
    'user/ajax_edit_email' => [ // 用户编辑邮箱
        ['field' => 'email', 'label' => 'Email', 'rules'=> 'trim|required|valid_email'],
    ],
    'user/ajax_edit_password' => [ // 用户编辑密码
        ['field' => 'user_current_password', 'label' => '旧密码', 'rules'=> 'trim|required'],
        ['field' => 'user_password', 'label' => '新密码', 'rules'=> 'trim|required'],
        ['field' => 'user_password_confirmation', 'label' => '新密码确认', 'rules'=> 'trim|required|matches[user_password]'],
    ],
    'password/ajaxFindPwd' => [ // ajax提交密码找回邮件
        ['field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'],
    ],
    'password/find'        => [ // 用户找回密码
        ['field' => 'password', 'label' => '新密码', 'rules' => 'trim|required'],
        ['field' => 'password_confirmation', 'label' => '新密码确认', 'rules' => 'trim|required|matches[password]'],
    ],
    'product/nologin_pay'         =>[  // 未登录购物支付
        ['field' => 'plan', 'label' => '计划期数', 'rules' => 'trim|required|integer|in_list[1,3,6,12]'],
        ['field' => 'tsize', 'label' => 'T-shirt尺寸', 'rules' => 'trim'],
        ['field' => 'post_email', 'label' => '邮箱', 'rules' => 'trim|required|valid_email|is_unique[user.login_email]'],
        ['field' => 'password', 'label' => '密码', 'rules' => 'trim|required'],
        ['field' => 'post_name', 'label' => '姓名', 'rules' => 'trim|required'],
        ['field' => 'post_phone', 'label' => '电话', 'rules' => 'trim|required|integer'],
        ['field' => 'post_addr', 'label' => '送货地址', 'rules' => 'trim|required'],
        ['field' => 'payway', 'label' => '支付方式', 'rules' => 'trim|required|in_list[alipay]'],
    ],
    'product/pay'         =>[  // 登录购物支付
        ['field' => 'box_id', 'label' => '盒子', 'rules' => 'trim|required|integer'],
        ['field' => 'plan', 'label' => '计划期数', 'rules' => 'trim|required|integer|in_list[1,3,6,12]'],
        ['field' => 'tsize', 'label' => 'T-shirt尺寸', 'rules' => 'trim'],
        ['field' => 'post_name', 'label' => '姓名', 'rules' => 'trim|required'],
        ['field' => 'post_phone', 'label' => '电话', 'rules' => 'trim|required|integer'],
        ['field' => 'post_addr', 'label' => '送货地址', 'rules' => 'trim|required'],
        ['field' => 'payway', 'label' => '支付方式', 'rules' => 'trim|required|in_list[alipay]'],
    ],
    'gift/pay'         =>[  // 订购礼物支付
        ['field' => 'box_id', 'label' => '盒子', 'rules' => 'trim|required|integer'],
        ['field' => 'plan', 'label' => '计划期数', 'rules' => 'trim|required|in_list[1,3,6,12]'],
        ['field' => 'shirt_sex', 'label' => 'T-shirt性别', 'rules' => 'trim|in_list[1, 2]'],
        ['field' => 'shirt_size', 'label' => 'T-shirt尺寸', 'rules' => "trim|in_list[S,M,L, XL, 2XL, 3XL, 4XL, 5XL]"],
        ['field' => 'post_name', 'label' => '姓名', 'rules' => 'trim|required'],
        ['field' => 'post_phone', 'label' => '电话', 'rules' => 'trim|required|integer'],
        ['field' => 'post_addr', 'label' => '送货地址', 'rules' => 'trim|required'],
        ['field' => 'gift_email', 'label' => '收件人的电子邮件', 'rules' => 'trim|required'],
        ['field' => 'gift_email_confirm', 'label' => '确认收件人的电子邮件', 'rules' => 'trim|required|matches[gift_email]'],
        ['field' => 'pay', 'label' => '支付方式', 'rules' => 'trim|required|in_list[alipay]'],
    ],
];