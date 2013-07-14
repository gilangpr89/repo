<?php

class MyIndo_Encryption_Password
{
	public static function makePassword($input)
	{
		return sha1(md5(sha1($input).md5($input).$input).$input);
	}
}