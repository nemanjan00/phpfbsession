<?php
require_once("./vendor/autoload.php");
require_once("./Config.php");
require_once("./Parser.php");

$config = new Config;

$parser = new Parser($config->get("accounts"));

echo $parser->get("https://www.facebook.com/");

