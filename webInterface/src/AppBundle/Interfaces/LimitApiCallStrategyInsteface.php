<?php

namespace AppBundle\Interfaces;

use AppBundle\Exceptions\ExceededTimeLimitException;

interface LimitApiCallStrategyInsteface 
{
	/**
	 * @param array $params that allows you to pass a various values
	 * @throws ExceededTimeLimitException
	 */
	public function applyPolicy(array $params);
	
	/**
	 * @param DateTime $lastTime The last time that an api has been called
	 */
	public function estimateNextTime(\DateTime $lastTime);
	
	/**
	 * @param mixed $limit How oftet the api gets called
	 */
	public function setTimeLimit($limit);
}