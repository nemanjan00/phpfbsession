<?php
require_once("./Config.php");
require_once("./Account.php");

$config = new Config;

$account = [];

$account["userId"] = "";
$account["fb_dtsg"] = "";

echo "cookies: ";

$account["cookies"] = "";

while(($line = trim(fgets(STDIN))) !== ""){
	$account["cookies"] .= "$line\n";
}

$account["cookies"] = trim($account["cookies"]);

$account = new Account($account);
$account = $account->getDetails();

$accounts = $config->get("accounts");
$accounts[$account["userId"]] = $account;

$config->set("accounts", $accounts);

