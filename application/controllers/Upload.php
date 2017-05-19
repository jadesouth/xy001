<?php

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
        $image_name = array_keys($_FILES);
        $image_name = $image_name[0];
        if (empty($image_name)) {
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

    /**
     * showWallImage 上传展示墙图片
     */
    public function showWallImage()
    {
        $folder_data = date('Ymd', time());
        $this->_config['upload_path'] = FCPATH . 'resources/uploads/show_wall/' . $folder_data;
        $this->_config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
        $this->_config['max_size'] = 10240;
        // init upload
        $this->upload->initialize($this->_config);
        // upload
        if (true === $this->upload->do_upload('show-wall-image')) { // success
            // 获取上传图片的信息
            $upload_file = $this->upload->data();
            $file_path = 'show_wall/' . $folder_data . '/' . $upload_file['orig_name'];
            http_ajax_response(0, '展示墙图片上传成功', ['show_wall' => $file_path]);
        } else { // failed
            $this->send_failure_msg();
        }
    }

    /**
     * voteImage 上传投票图片
     */
    public function voteImage()
    {
        $folder_data = date('Ymd', time());
        $this->_config['upload_path'] = FCPATH . 'resources/uploads/vote/' . $folder_data;
        $this->_config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
        $this->_config['max_size'] = 10240;
        // init upload
        $this->upload->initialize($this->_config);
        // upload
        if (true === $this->upload->do_upload('vote-image')) { // success
            // 获取上传图片的信息
            $upload_file = $this->upload->data();
            $file_path = 'vote/' . $folder_data . '/' . $upload_file['orig_name'];
            http_ajax_response(0, '投票图片上传成功', ['vote' => $file_path]);
        } else { // failed
            $this->send_failure_msg();
        }
    }

    private function send_failure_msg()
    {
        $failure_msg = $this->upload->display_errors('', '');
        $failure_msg = empty($failure_msg) ? '上传失败!' : $failure_msg;
        http_ajax_response(1, $failure_msg);
    }
}
