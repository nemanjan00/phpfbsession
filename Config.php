<?php
Class Config{
	public function get($attr){
		return json_decode(file_get_contents("./config.json"), true)[$attr];
	}

	public function set($attr, $value){
		$config = json_decode(file_get_contents("./config.json"), true);

		$config[$attr] = $value;

		file_put_contents("./config.json", json_encode($config));
	}
}
