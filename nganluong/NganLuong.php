<?php

namespace NF\Payment;

use NF\Payments\PaymentInterface;
use NF\Payment\NganLuong\Model\NganluongModel;

/**
 *
 */
class NganLuong implements PaymentInterface
{
    protected $model;
    // protected $url_card_post = 'https://www.nganluong.vn/mobile_card.api.post.v2.php';
    protected $url_card_post = 'https://sandbox.nganluong.vn:8088/nl30/mobile_card.api.post.v2.php';
    public $arr_param      = [];
    public function __construct($data)
    {
        $this->model     = new NganluongModel();
        $this->arr_param = [
            'func'              => $this->model->getFunction(),
            'version'           => $this->model->getVersion(),
            'merchant_id'       => $this->model->getMerchantId(),
            'merchant_account'  => $this->model->getEmailRecieve(),
            'merchant_password' => md5($this->model->getMerchantId() . '|' . $this->model->getMerchantPassword()),
            'pin_card'          => $data['pin'],
            'card_serial'       => $data['seri'],
            'type_card'         => $data['mang'],
            'ref_code'          => $data['order_id'],
            'client_fullname'   => (!empty($data['fullname']) ? $data['fullname'] : 'Không có tên'),
            'client_email'      => $data['email'],
            'client_mobile'     => (!empty($data['phone']) ? $data['phone'] : ''),
        ];
    }

    public function sendRequest()
    {
        $post_field = '';
        foreach ($this->arr_param as $key => $value) {
            if ($post_field != '') {
                $post_field .= '&';
            }

            $post_field .= $key . "=" . $value;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url_card_post);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field);
        $result = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error  = curl_error($ch);

        $data = [
            'status' => $status,
            'error'  => $error,
            'result' => $result,
        ];
        return json_encode($data);
    }
}
