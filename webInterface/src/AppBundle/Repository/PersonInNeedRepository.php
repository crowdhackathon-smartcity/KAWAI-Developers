<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\PersonInNeed;
use AppBundle\Interfaces\GenerateUniqueStrategy;

class PersonInNeedRepository extends EntityRepository
{
	private $uniqueStrategy;
	
	public function __construct(GenerateUniqueStrategy $uniqueStrategy)
	{
		$this->uniqueStrategy=$uniqueStrategy;	
	}
	
	/**
	 * @param string $pin The pin provided to the person In need by a social worker
	 * @return PersonInNeed
	 */
	public function getPersonInNeedByPin($pin)
	{
		return $this->getEntityManager()->findOneByPin($pin);
	}
	
	/**
	 * @param string $name 
	 * @param string $surname
	 * @return PersonInNeed
	 */
	public function registerPersonInNeed($name,$surname)
	{
		$em=$this->getEntityManager();
		$personInNeed= new PersonInNeed();
		
		$personInNeed->setName($name);
		$personInNeed->setSurname($surname);
		
		$pin=$this->uniqueStrategy->generateUnique(0);//Number does not count
		$personInNeed->setPin($pin);
		
		$em->persist($personInNeed);
		$em->flush();
		
		return $personInNeed;
	}
	
	/**
	 * @param string $name
	 * @param string $surname
	 * @param string $pin
	 * @return PersonInNeed[]
	 */
	public function searchPersonInNeed($name="",$surname="",$pin="")
	{
		//TODO: To be implemented depending the case
	}
	
}