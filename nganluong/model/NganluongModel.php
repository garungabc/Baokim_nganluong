<?php

namespace NF\Payment\NganLuong\Model;
/**
 *
 */
class NganluongModel
{
	/**
	 * [$_FUNCTION description]
	 * @var string
	 */
    private $_FUNCTION = 'CardCharge';
    /**
     * [$_VERSION description]
     * @var string
     */
    private $_VERSION  = "2.0";
    private $_MERCHANT_ID;
    /**
     * [$_MERCHANT_PASSWORD description]
     * @var [type]
     */
    private $_MERCHANT_PASSWORD;
    /**
     * [$_EMAIL_RECEIVE_MONEY description]
     * @var [type]
     */
    private $_EMAIL_RECEIVE_MONEY;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->_FUNCTION            = 'CardCharge';
        $this->_VERSION             = "2.0";
        //============= for live .vicoders.com
        // $this->_MERCHANT_ID         = '52284';
        // $this->_MERCHANT_PASSWORD   = '25447a9d48b512022ad5cd7b97b70ffa';
        // $this->_EMAIL_RECEIVE_MONEY = 'canmotcaiten1993@gmail.com';
        // 
        // ========= for .dev =====
        $this->_MERCHANT_ID         = '45880';
        $this->_MERCHANT_PASSWORD   = '4b741318d9f698a73d3eb658546c57a1';
        $this->_EMAIL_RECEIVE_MONEY = 'daudq.info@gmail.com';

        //=========== sanbox for .vicoders.com =========
        // $this->_MERCHANT_ID         = '45879';
        // $this->_MERCHANT_PASSWORD   = 'bf87e4a2f8dc093c5beb85064ed15387';
        // $this->_EMAIL_RECEIVE_MONEY = 'daudq.info@gmail.com';
    }

    // public function setFunction($function_name) {
    // 	$this->_FUNCTION = $function_name;
    // }

    // public function setVersion($version) {
    // 	$this->_VERSION = $version;
    // }

    // public function setMerchantID($merchantid) {
    // 	$this->_MERCHANT_ID = $merchantid;
    // }

    // public function setMerchantPass($merchantpass) {
    // 	$this->_MERCHANT_PASSWORD = $merchantpass;
    // }

    // public function setEmailRecieve($email_recieve) {
    // 	$this->_EMAIL_RECEIVE_MONEY = $email_recieve;
    // }

    public function getFunction() {
    	return $this->_FUNCTION;
    }

    public function getVersion() {
    	return $this->_VERSION;
    }

    public function getMerchantId() {
    	return $this->_MERCHANT_ID;
    }

    public function getMerchantPassword() {
    	return $this->_MERCHANT_PASSWORD;
    }

    public function getEmailRecieve() {
    	return $this->_EMAIL_RECEIVE_MONEY;
    }
}
