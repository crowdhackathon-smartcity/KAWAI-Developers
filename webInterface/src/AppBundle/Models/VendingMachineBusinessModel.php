<?php

namespace AppBundle\Models;

use AppBundle\Interfaces\GenerateUniqueStrategy;
use AppBundle\Repository\VendingMachineRepository;

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
}