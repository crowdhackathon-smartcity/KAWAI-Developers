<?php

namespace AppBundle\Exceptions;

class NoVendingMachineFoundException extends \Exception 
{
	public function __construct()
	{
		parent::__construct('There is no a such vending machine');
	}
}