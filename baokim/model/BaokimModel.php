<?php  

namespace NF\Payment\Model;

/**
* Baokim Model
*/
class BaokimModel
{
	/**
	 * [$CORE_API_HTTP_USR description]
	 * @var [type]
	 */
	private $CORE_API_HTTP_USR;
	/**
	 * [$CORE_API_HTTP_PWD description]
	 * @var [type]
	 */
	private $CORE_API_HTTP_PWD;
	/**
	 * [$merchant_id description]
	 * @var [type]
	 */
	private $merchant_id;
	/**
	 * [$api_username description]
	 * @var [type]
	 */
	private $api_username;
	/**
	 * [$api_password description]
	 * @var [type]
	 */
	private $api_password;

	/**
	 * [$secure_code secure code when register domain with baokim success ]
	 * @var [type]
	 */
	private $secure_code;
	public function __construct()
	{
		// $this->CORE_API_HTTP_USR = 'merchant_30708'; // dont need
		// $this->CORE_API_HTTP_PWD = '30708mQ2L8ifR11axUuCN9PMqJrlAHFS04o';  // dont need
		$this->merchant_id = '30708';
		$this->api_username = 'downloadtailieuvicoderscom';
		$this->api_password = 'NRtjMqohpXwu3m7MrjjY';
		$this->secure_code = '6212F60780C38157';
	}

	public function createTransactionID() {
		return time();
	}

	public function merchant_id() {
		return $this->merchant_id;
	}

	public function getApiUsername() {
		return $this->api_username;
	}

	public function getApiPassword() {
		return $this->api_password;
	}

	public function getSecureCode() {
		return $this->secure_code;
	} 

	public function getCoreApiHttpUsr() {
		return $this->CORE_API_HTTP_USR;
	}

	public function getCoreApiHttpPwd() {
		return $this->CORE_API_HTTP_PWD;
	}
}