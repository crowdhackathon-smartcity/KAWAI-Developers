<?php

namespace AppBundle\Stategies;

use AppBundle\Interfaces\GenerateUniqueStrategy;

class VariableLengthUniqieSrtingStrategy implements GenerateUniqueStrategy {
	
	private $stringLength;
	
	public function __construct($stringlength)
	{
		$this->stringLength=$stringlength;
	}
	
	public function generateUnique($seed = null) 
	{
		$string=gethostname().openssl_random_pseudo_bytes(16);
		$string=hash('sha256',uniqid($string));
		return substr($string, 0,$this->stringLength);
	}
}