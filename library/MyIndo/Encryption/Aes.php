<?php

class MyIndo_Encryption_Aes
{
	protected $_cipher;
	protected $_iv_size;
	protected $_key;
	protected $_iv;
	
	function __construct($key = null, $iv = null)
	{
		
		$this->_cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_256, '', MCRYPT_MODE_CBC, '');
		$this->_iv_size = mcrypt_enc_get_iv_size($this->_cipher);
		
		if(!is_null($key) && strlen($key) <= 32) {
			$this->_key = $key;
		} else {
			$this->_key = '12345678901234561234567890123456';
		}
		
		if(!is_null($iv) && strlen($iv) == 32) {
			$this->_iv = $iv;
		} else {
			$this->_iv = '9532654BD781547023AB4FA7723F2FCD';
		}
	}
	
	public function encrypt($text, $key = null)
	{
		if(!is_null($key) && strlen($key) <= 32) {
			$this->_key = $key;
		}
		mcrypt_generic_init($this->_cipher, $this->_key, $this->_iv);
		$encrypted = mcrypt_generic($this->_cipher, $text);
		mcrypt_generic_deinit($this->_cipher);
		return bin2hex($encrypted);
	}
	
	public function decrypt($str, $key = null)
	{
		if(!is_null($key) && strlen($key) <= 32) {
			$this->_key = $key;
		}
		mcrypt_generic_init($this->_cipher, $this->_key, $this->_iv);
		$decrypted = mdecrypt_generic($this->_cipher, $this->hex2bin($str));
		mcrypt_generic_deinit($this->_cipher);
		return $decrypted;
	}
	
	public function base64encrypt($text, $key = null)
	{
		if(!is_null($key) && strlen($key) <= 32) {
			$this->_key = $key;
		}
		mcrypt_generic_init($this->_cipher, $this->_key, $this->_iv);
		$encrypted = mcrypt_generic($this->_cipher, $text);
		mcrypt_generic_deinit($this->_cipher);
		return base64_encode(bin2hex($encrypted));
	}
	
	public function base64decrypt($str, $key = null)
	{
		if(!is_null($key) && key <= 32) {
			$this->_key = $key;
		}
		mcrypt_generic_init($this->_cipher, $this->_key, $this->_iv);
		$decrypted = mdecrypt_generic($this->_cipher, $this->hex2bin(base64_decode($str)));
		mcrypt_generic_deinit($this->_cipher);
		return $decrypted;
	}
	
	public function setKey($key)
	{
		if(strlen($key) <= 32) {
			$this->_key = $key;
		}
	}
	
	public function getKey()
	{
		return $this->_key;
	}
	
	public function setIv($iv)
	{
		if(strlen($iv) === 32) {
			$this->_iv = $iv;
		}
	}
	
	public function getIv()
	{
		return $this->_iv;
	}
	
	protected function hex2bin($hex_string) {
	    $pos = 0;
		$result = '';
		while ($pos < strlen($hex_string)) {
		  if (strpos(" \t\n\r", $hex_string{$pos}) !== FALSE) {
		    $pos++;
		  } else {
		    $code = hexdec(substr($hex_string, $pos, 2));
			$pos = $pos + 2;
		    $result .= chr($code); 
		  }
		}
		return $result;
	}
}