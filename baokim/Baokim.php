<?php

namespace NF\Payment;

use NF\Payment\Model\BaokimModel;
use NF\Payments\PaymentInterface;

/**
 * BaoKim portal
 */
class Baokim implements PaymentInterface
{
    /**
     * [$baokimmodel Object baokim]
     * @var [type]
     */
    protected $baokimmodel;
    /**
     * [$arr_params array parameters need to send to server]
     * @var array
     */
    public $arr_params = [];

    public $bk_requestURL = 'https://www.baokim.vn/the-cao/restFul/send';

    public function __construct($data)
    {
        $this->baokimmodel = new BaokimModel();
        $this->arr_params = array(
            'merchant_id'    => $this->baokimmodel->merchant_id(),
            'api_username'   => $this->baokimmodel->getApiUsername(),
            'api_password'   => $this->baokimmodel->getApiPassword(),
            'transaction_id' => $this->baokimmodel->createTransactionID(),
            'card_id'        => $data['mang'],
            'pin_field'      => $data['pin'],
            'seri_field'     => $data['seri'],
            'algo_mode'      => 'hmac',
        );
    }
    
    public function sendRequest()
    {
        ksort($this->arr_params);

        $data_sign = hash_hmac('SHA1', implode('', $this->arr_params), $this->baokimmodel->getSecureCode());

        $this->arr_params['data_sign'] = $data_sign;

        $curl = curl_init($this->bk_requestURL);

        curl_setopt_array($curl, array(
            CURLOPT_POST           => true,
            CURLOPT_HEADER         => false,
            CURLINFO_HEADER_OUT    => true,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPAUTH       => CURLAUTH_DIGEST | CURLAUTH_BASIC,
            // CURLOPT_USERPWD        => ($this->baokimmodel->getCoreApiHttpUsr()) . ':' . ($this->baokimmodel->getCoreApiHttpPwd()),
            CURLOPT_POSTFIELDS     => http_build_query($this->arr_params),
        ));

        $data = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($data, true);

        $data = [
            'status' => $status,
            'result' => $result
        ]; 

        return json_encode($data);

        //date_default_timezone_set('Asia/Ho_Chi_Minh');

        // $time = time();

        //     if ($status == 200) {
        //         $amount = $result['amount'];
        //         switch ($amount) {
        //             case 10000:$xu = 10000;
        //                 break;
        //             case 20000:$xu = 20000;
        //                 break;
        //             case 30000:$xu = 30000;
        //                 break;
        //             case 50000:$xu = 50000;
        //                 break;
        //             case 100000:$xu = 100000;
        //                 break;
        //             case 200000:$xu = 200000;
        //                 break;
        //             case 300000:$xu = 300000;
        //                 break;
        //             case 500000:$xu = 500000;
        //                 break;
        //             case 1000000:$xu = 1000000;
        //                 break;
        //         }
        //         //$dbhost="localhost";
        //         //$dbuser ="xemtruoc_ngaydep";
        //         //$dbpass = "BL&v7Wd#hj07";
        //         //$dbname = "xemtruoc_tuonglai";
        //         //$db = mysql_connect($dbhost,$dbuser,$dbpass) or die("cant connect db");
        //         //mysql_select_db($dbname,$db) or die("cant select db");

        //         //mysql_query("UPDATE hqhpt_users SET tien = tien + $xu WHERE username  ='$user';");

        //         // Xu ly thong tin tai day
        //         $file = "carddung.log";
        //         $fh   = fopen($file, 'a') or die("cant open file");
        //         fwrite($fh, "Tai khoan: " . $user . ", Loai the: " . $ten . ", Menh gia: " . $amount . ", Thoi gian: " . $time);
        //         fwrite($fh, "\r\n");
        //         fclose($fh);
        //         echo '<script>alert("Bạn đã thanh toán thành công thẻ ' . $ten . ' mệnh giá ' . $amount . ' ");
        //  window.location = "http://macintosh.vn"
        // </script>';

        //     } else {
        //         echo 'Status Code:' . $status . '<hr >';
        //         $error = $result['errorMessage'];
        //         echo $error;
        //         $file = "cardsai.log";
        //         $fh   = fopen($file, 'a') or die("cant open file");
        //         fwrite($fh, "Tai khoan: " . $user . ", Ma the: " . $sopin . ", Seri: " . $seri . ", Noi dung loi: " . $error . ", Thoi gian: " . $time);
        //         fwrite($fh, "\r\n");
        //         fclose($fh);
        //         echo '<script>alert("Thong tin the cao khong hop le!");
        //     window.location = "http://macintosh.vn/napthe/"
        // </script>';
        //     }
    }

}
