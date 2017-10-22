<?php
require_once("./Account.php");

Class Parser {
	private $cookieFile;
	private $fb_dtsg;
	private $userId;

	private $accounts;

	public function __construct($accounts){
		$this->accounts = $accounts;

		$this->swapAccount();
	}

	private function swapAccount(){
		echo "Changing account... \n";

		if(count($this->accounts) == 0){
			echo "No more accounts... \n";

			echo "Press enter to continue... \n";
			system("read test");
			die();
		}
		else
		{
			$account = array_pop($this->accounts);

			$accountObj = new Account($account);

			$this->cookieFile = tempnam("/tmp", "cookies");

			file_put_contents($this->cookieFile, $account["cookies"]);
			$this->fb_dtsg = $account["fb_dtsg"];
			$this->userId = $account["userId"];

			echo "Changed account to ".$this->userId."... \n";
		}
	}

	public function get($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);

		$headers = [
			"user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36"
		];

		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookieFile);

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);
		curl_close($ch);

		return $server_output;
	}
}

