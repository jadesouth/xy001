<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 后台相关配置文件
 *
 * @author wangnan <wangnanphp@163.com>
 * @date   2016-11-13 20:17:30
 */
$config = [
    // 管理员管理
    'admin' => [
        'name'         => '管理员',
        'index'        => '管理员列表',
        'add'          => '添加管理员',
        'edit'         => '修改管理员',
        'table_header' => ['#', '登录账号', '添加时间', '状态<br>0:禁用,1:正常', '操作'],
        'index_field'  => 'id,login_name,created_at,status',
    ],
    // 主题管理
    'theme' => [
        'name'         => '主题',
        'index'        => '主题列表',
        'add'          => '添加主题',
        'table_header' => ['#', '主题名称', '添加时间'],
        'index_field'  => 'id,name,created_at',
    ],
    // 用户管理
    'user' => [
        'name'         => '用户',
        'index'        => '用户列表',
        'table_header' => ['#', '登录账号', '名称', '邮寄电话', '添加时间', '状态', '操作'],
        'index_field'  => 'id,login_email,name,post_phone,created_at,status',
    ],
    // 订单管理
    'order' => [
        'name'         => '订单',
        'index'        => '订单列表',
        'table_header' => ['#', '邮寄姓名', '邮寄电话', '邮寄地址', '计划', '下月是否'],
        'index_field'  => 'id,order_number,plan_number,post_name,post_phone,post_addr,status,created_at',
    ],
    // 菜单管理
    'menu' => [
        'name'         => '菜单',
        'index'        => '菜单列表',
        'add'          => '添加主题',
        'edit'         => '修改菜单',
        'table_header' => ['#', '菜单名称', '链接地址', '排序', '状态', '操作'],
        'index_field'  => 'id,name,url,list_order,status',
    ],
    // 盒子管理
    'box' => [
        'name'         => '盒子',
        'index'        => '盒子列表',
        'table_header' => ['#', '名称', '主题', '年', '月', '操作'],
        'index_field'  => 'id,name,theme_name,year,month',
    ],
];
