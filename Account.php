<?php
Class Account{
	private $userId;
	private $fb_dtsg;
	private $cookieFile;

	private $cookies;

	public function __construct($account){
		$this->cookies = $account["cookies"];

		$this->cookieFile = tempnam("/tmp", "cookies");

		file_put_contents($this->cookieFile, $account["cookies"]);
		$this->fb_dtsg = $account["fb_dtsg"];
		$this->userId = $account["userId"];
	}

	public function checkAccount(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://facebook.com/me");

		$headers = [
			"user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36"
		];

		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookieFile);

		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_exec ($ch);

		return curl_getinfo($ch, CURLINFO_EFFECTIVE_URL) !== "https://www.facebook.com/";
	}

	public function getDetails(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://www.facebook.com/");

		$headers = [
			"user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36"
		];

		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookieFile);

		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);

		$userId = explode("\"", explode("ORIGINAL_USER_ID\":\"", $server_output)[1])[0];
		$fb_dtsg = explode("\"", explode("fb_dtsg\" value=\"", $server_output)[1])[0];

		return [
			"cookies" => $this->cookies,
			"fb_dtsg" => $fb_dtsg,
			"userId" => $userId
		];
	}
}

