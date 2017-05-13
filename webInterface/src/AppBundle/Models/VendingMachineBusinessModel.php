<?php

namespace AppBundle\Models;

use AppBundle\Interfaces\GenerateUniqueStrategy;
use AppBundle\Repository\VendingMachineRepository;
use AppBundle\Exceptions\NoVendingMachineFoundException;
use AppBundle\Entity\VendingMachine;

class VendingMachineBusinessModel 
{
	private $keyGenerationStrategy;
	private $secretGenerationStrategy;
	
	public function __construct(GenerateUniqueStrategy $keyGenerationStrategy,GenerateUniqueStrategy $secretGenerationStrategy, VendingMachineRepository $vendingMachineRepository )
	{
		$this->keyGenerationStrategy=$keyGenerationStrategy;
		$this->secretGenerationStrategy=$secretGenerationStrategy;
		$this->vendingMachineRepository=$vendingMachineRepository;
	}
	
	/**
	 * @param unknown $name
	 * @return \AppBundle\Entity\VendingMachine
	 */
	public function addVendingMachine($name)
	{
		$key=$this->keyGenerationStrategy->generateUnique();
		$secret=$this->keyGenerationStrategy->generateUnique();
		
		return $this->vendingMachineRepository->resisterANewVendingMachine($name,$key,$secret);
	}
	
	/**
	 * 
	 * @param string $key
	 * @param string $secret
	 * @throws NoVendingMachineFoundException
	 * @return boolean
	 */
	public function verifyVendingMachine($key,$secret)
	{
		/**
		 * @var VendingMachine $vendingMachine
		 */
		$vendingMachine=$this->vendingMachineRepository->getVendingMachineByKey($key);
		
		if($vendingMachine===null){
			throw new NoVendingMachineFoundException();
		} else if(password_verify($secret, $vendingMachine->getSec)) {
			return true;
		}
		
		return false;
	}
}