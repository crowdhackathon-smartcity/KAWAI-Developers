<?php

namespace AppBundle\Models;

use AppBundle\Repository\PersonInNeedRepository;
use AppBundle\Interfaces\GenerateUniqueStrategy;
use AppBundle\Entity\PersonInNeed;

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
	
	/**
	 * 
	 * @param string $name
	 * @param string $surname
	 * @param string $reason
	 * @return PersonInNeed
	 */
	public function registerPersonInNeed($name,$surname,$reason)
	{
		$pin=$this->pinUniqueGenerator->generateUnique();
		return $this->personInNeedRepository->registerPersonInNeed($name, $surname, $pin, $reason);
	}
	
	public function getPersonInNeedByPin($pin)
	{
		return $this->personInNeedRepository->getPersonInNeedByPin($pin);
	}
	
	public function getPersonById($id)
	{
		return $this->personInNeedRepository->getPersonInNeedById($id);
	}
}