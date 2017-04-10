<?php
/**
 * Created by PhpStorm.
 * User: wangnan
 * Date: 16-5-7
 * Time: 上午10:36
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Upload 处理各种上传任务
 */
class Upload extends MY_Controller
{
    private $_config = [];

    /**
     * Upload constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('http');
        $this->load->library('upload');

        // 设置基础的上传配置
        $this->_config = [
            'upload_path'      => PATH_UPLOAD . date('Ymd', time()),
            'allowed_types'    => 'zip|7zip|rar|doc|docx|word|xls|xlsx|xl|ppt|pptx|pdf|txt|wma|rm|wav|wmv|avi|mp4|flv|swf|psd|gif|jpg|jpeg|png|bmp',
            'file_name'        => intval(microtime(true) * 10000),
            'file_ext_tolower' => true, // 文件后缀名将转换为小写
            'max_size'         => UPLOAD_FILE_MAX_SIZE,
        ];
    }

    public function image()
    {

        if (empty($image_name = array_keys($_FILES)[0])) {
            http_ajax_response(1, '上传图片非法');
            return;
        }

        $this->_config['allowed_types'] = 'gif|jpg|png|bmp';
        $this->upload->initialize($this->_config);
        // upload
        if (true === $this->upload->do_upload($image_name)) { // success
            // 获取上传图片的信息
            $upload_file = $this->upload->data();
            $folder_name = date('Ymd', time());
            $img_url = site_url() . FOLDER_UPLOAD . $folder_name . DS . $upload_file['file_name'];

            http_ajax_response(0, 'OK', ['image_url' => $img_url]);
        } else { // failed
            $this->send_failure_msg();
        }
    }
}