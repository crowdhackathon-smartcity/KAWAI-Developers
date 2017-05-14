<?php

namespace AppBundle\Stategies;

use AppBundle\Interfaces\LimitApiCallStrategyInsteface;
use AppBundle\Repository\PersonInNeedPerVendingRepository;
use AppBundle\Constants\PersonInNeedConstats;
use AppBundle\Constants\VendingMachineConstants;
use AppBundle\Entity\PersonInNeed;
use AppBundle\Entity\VendingMachine;
use AppBundle\Exceptions\ExceededTimeLimitException;

class DoNotServeTwicePerVendingMachineStrategy implements LimitApiCallStrategyInsteface 
{
	
	/**
	 * @var PersonInNeedPerVendingRepository
	 */
	private $personInNeedPerVending=null;
	
	/**
	 * @var \DateInterval
	 */
	private $timeLimit=null;
	
	public function __construct(
			PersonInNeedPerVendingRepository $personInNeedPerVending,
			$timelimit
	){
		$this->personInNeedPerVending=$personInNeedPerVending;
		$this->setTimeLimit(intval($timelimit)." hours");
	}
	
	/**
	 * @param PersonInNeed $personInNeed
	 * @param VendingMachine $vendingMachine
	 * @return DateTime
	 */
	private function getLastTimeUsed(PersonInNeed $personInNeed, VendingMachine $vendingMachine)
	{	
		return $this->personInNeedPerVending->getLastTimePerdonInNeedUsedVendingMachine($personInNeed, $vendingMachine);
	}
	
	
	private function isTimeExceededTimeLimit(\DateTime $date)
	{
		$now=new \DateTime();
		$limit=$date->add($this->timeLimit);
		
		return $limit > $now;
	}
	
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Interfaces\LimitApiCallStrategyInsteface::applyPolicy()
	 * @return bool
	 * @throws \Exception
	 */
	public function applyPolicy(array $params) 
	{
		$personInNeed=$params[PersonInNeedConstats::PERSON_IN_NEED];
		$vendingMachine=$params[VendingMachineConstants::VENDING_MACHINE];
		
		if(empty($personInNeed) || empty($vendingMachine)){
			throw \Exception('Please provide a person and a vending machine Entity');
		}
		
		$lastTime=$this->personInNeedPerVending->getLastTimePerdonInNeedUsedVendingMachine($personInNeed, $vendingMachine);
		if(empty($lastTime['date'])){
			return;
		}
		$date=\Datetime::createFromFormat('Y-m-d', $lastTime['date']);
		if($this->isTimeExceededTimeLimit($date)){
			throw new ExceededTimeLimitException('api call', $this->estimateNextTime($date));
		}
	}
	
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Interfaces\LimitApiCallStrategyInsteface::estimateNextTime()
	 */
	public function estimateNextTime(\DateTime $lastTime)
	{
		return $lastTime->add($this->timeLimit);
	}
	
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Interfaces\LimitApiCallStrategyInsteface::setTimeLimit()
	 */
	public function setTimeLimit($limit) 
	{
		$this->timeLimit=\DateInterval::createFromDateString($limit);
		return $this;
	}

}