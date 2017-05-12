<?php

namespace AppBundle\Interfaces;

interface GenerateUniqueStrategy 
{
	/**
	 * @param string | int $seed
	 * @return string
	 */
	public function generateUnique($seed);
}