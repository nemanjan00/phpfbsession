<?php
ini_set('memory_limit','1G');
chdir(__DIR__."/");

require_once(__DIR__.'/vendor/autoload.php');

use PhpSchool\CliMenu\CliMenu;
use PhpSchool\CliMenu\CliMenuBuilder;

$itemCallable = function (CliMenu $menu) {
	$menu->close();

	include($menu->getSelectedItem()->getText());

	system("echo 'Press enter to continue...'; read test");

	menu();
};

function menu(){
	global $itemCallable;

	$menu = (new CliMenuBuilder)
		->setTitle('AutoInviter')
		->addItem('checkAccounts.php', $itemCallable)
		->addItem('addAccount.php', $itemCallable)
		->addLineBreak('-')
		->build();

	$menu->open();
}

menu();

