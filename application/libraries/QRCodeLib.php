<?php

/**
 * Class QRCodeLib
 */
class QRCodeLib
{
    /**
     * generateQRCodeImage 根据内容生成二维码
     *
     * @param $data
     */
    public function generateQRCodeImage($data)
    {
        include_once PATH_THIRD_PARTY . 'WxpayAPI_php_v3' . DS . 'example' . DS . 'phpqrcode' . DS . 'phpqrcode.php';

        return QRcode::png($data, false, QR_ECLEVEL_M, 9, 0);
    }
}