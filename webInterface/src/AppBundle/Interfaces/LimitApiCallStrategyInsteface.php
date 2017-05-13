<?php

namespace AppBundle\Interfaces;

interface LimitApiCallStrategyInsteface 
{
	/**
	 * @param array $params parameters that allows you to pass a various values
	 * @return bool
	 */
	public function applyPolicy(array $params);
}