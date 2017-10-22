<?php
require_once("./Config.php");
require_once("./Account.php");

$config = new Config;
$accounts = $config->get("accounts");

foreach($accounts as $account){
	$accountObj = new Account($account, $config->get("page"));

	echo $account["userId"]." - ".(($accountObj->checkAccount()?"OK":"NOT OK"))."\n";

	$accounts[$account["userId"]] = $accountObj->getDetails();
}

$config->set("accounts", $accounts);

