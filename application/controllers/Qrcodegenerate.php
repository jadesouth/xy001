<?php

/**
 * Class Qrcode
 */
class Qrcodegenerate extends Home_Controller
{
    /**
     * index 生成二维码
     */
    public function index()
    {
        $data = $this->input->get('data', true);
        $data = urldecode($data);
        empty($text) && $text = '';
        $this->load->library('QRCodeLib');
        return $this->qrcodelib->generateQRCodeImage($data);
    }
}