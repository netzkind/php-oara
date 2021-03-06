<?php
/**
 * Export Class
 *
 * @author     Carlos Morillo Merino
 * @category   Oara_Network_Publisher_Ladbrokers
 * @copyright  Fubra Limited
 * @version    Release: 01.00
 *
 */
class Oara_Network_Publisher_Ladbrokers extends Oara_Network {

	/**
	 * Client
	 * @var unknown_type
	 */
	private $_client = null;
	/**
	 * Constructor and Login
	 * @param $credentials
	 * @return Oara_Network_Publisher_Daisycon
	 */
	public function __construct($credentials) {
		$user = $credentials['user'];
		$password = $credentials['password'];

		$valuesLogin = array(
		new Oara_Curl_Parameter('j_username', $user),
		new Oara_Curl_Parameter('j_password', $password),
		new Oara_Curl_Parameter('submit1', 'GO')
		);

		
		$loginUrl = 'https://portal.ladbrokespartners.com/portal/j_spring_security_check';
		$this->_client = new Oara_Curl_Access($loginUrl, $valuesLogin, $credentials);


		$this->_exportPaymentParameters = array(new Oara_Curl_Parameter('action', 'do_report_payments'),
		new Oara_Curl_Parameter('daterange', '7')
		);

	}
	/**
	 * Check the connection
	 */
	public function checkConnection() {
		//If not login properly the construct launch an exception
		$connection = false;
		$urls = array();
		$urls[] = new Oara_Curl_Request('https://portal.ladbrokespartners.com/portal/dashboard.jhtm?currentLanguage=en', array());
		$exportReport = $this->_client->get($urls);

		
		if (preg_match("/Logout/", $exportReport[0])) {
			$connection = true;
		}
		return $connection;
	}
	/**
	 * (non-PHPdoc)
	 * @see library/Oara/Network/Oara_Network_Publisher_Interface#getMerchantList()
	 */
	public function getMerchantList() {
		$merchants = array();

		$obj = array();
		$obj['cid'] = 1;
		$obj['name'] = "Ladbrokers";
		$merchants[] = $obj;

		return $merchants;
	}

	/**
	 * (non-PHPdoc)
	 * @see library/Oara/Network/Oara_Network_Publisher_Interface#getTransactionList($aMerchantIds, $dStartDate, $dEndDate, $sTransactionStatus)
	 */
	public function getTransactionList($merchantList = null, Zend_Date $dStartDate = null, Zend_Date $dEndDate = null, $merchantMap = null) {

		$totalTransactions = array();

		

		return $totalTransactions;
	}

}
