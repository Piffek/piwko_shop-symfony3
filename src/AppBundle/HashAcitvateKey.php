<?php
namespace AppBundle;

class HashAcitvateKey
{
	
	public function __construct(){
		$this->salt = 'piffekShopWithLibrary';
	}
	
	public function hash(){
		$key = rand(0, 10000);
		return SHA1($key.$this->salt);
	}
}