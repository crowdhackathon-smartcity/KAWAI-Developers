<?php

namespace AppBundle\Stategies;

use AppBundle\Interfaces\GenerateUniqueStrategy;

class GenerateUniqueFourDigitNumber implements GenerateUniqueStrategy
{
	const RANDOM_DIGIT_LIMIT=4;
	
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Interfaces\GenerateUniqueStrategy::generateUnique()
	 */
	public function generateUnique($seed=null) 
	{
		$string=uniqid(gethostname(),true);	
		$value=strval(hexdec(sha1($string))*1000);
		$value=str_replace('.','',$value);
		$value=substr($value,0,self::RANDOM_DIGIT_LIMIT);
		return $value;
	}

}