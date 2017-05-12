<?php

namespace AppBundle\Models;

use AppBundle\Repository\PersonInNeedRepository;
use AppBundle\Interfaces\GenerateUniqueStrategy;

class PersonInNeedBusinessLogicModel
{
	/**
	 * 
	 * @var PersonInNeedRepository
	 */
	private $personInNeedRepository=null;
	private $pinUniqueGenerator=null;
	
	public function __construct(PersonInNeedRepository $repository,GenerateUniqueStrategy $pinUniqueGenerator)
	{
		$this->personInNeedRepository=$repository;
		$this->pinUniqueGenerator=$pinUniqueGenerator;
	}
	
	public function registerPersonInNeed()
	{
		
	}
	
	public function getPersonInNeedByPin($pin)
	{
		return $this->personInNeedRepository->getPersonInNeedByPin($pin);
	}
}