<?php

namespace AppBundle\Exceptions;

class ExceededTimeLimitException extends \Exception
{
	private $newTime;
	
	public function __construct($actionDescription,\DateTime $newTime)
	{
		parent::__construct("The $actionDescription exceeded the Time Limit please try again later");
		$this->newTime=$newTime;
	}
	
	/**
	 * @return DateTime
	 */
	public function getNewTime()
	{
		return $this->newTime;
	}
}