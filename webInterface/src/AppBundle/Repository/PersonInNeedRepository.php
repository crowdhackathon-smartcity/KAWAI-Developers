<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\PersonInNeed;
use AppBundle\Interfaces\GenerateUniqueStrategy;
use Doctrine\ORM\Mapping\ClassMetadata;

class PersonInNeedRepository extends EntityRepository
{
	private $uniqueStrategy;
	
	public function __construct($em, ClassMetadata $class)
	{
		parent::__construct($em, $class);	
	}
	
	/**
	 * @param string $pin The pin provided to the person In need by a social worker
	 * @return PersonInNeed
	 */
	public function getPersonInNeedByPin($pin)
	{
		$query=$this->getEntityManager()->createQueryBuilder('p')->from('AppBundle:PersonInNeed','p');
		
		$query->select('p')->where('p.pin = :pin')->setParameter(':pin', $pin);
		
		$query = $query->getQuery();
		return $query->getOneOrNullResult();
	}
	
	/**
	 * @param string $name 
	 * @param string $surname
	 * @return PersonInNeed
	 */
	public function registerPersonInNeed($name,$surname,$pin,$reason)
	{
		$em=$this->getEntityManager();
		$personInNeed= new PersonInNeed();
		
		$personInNeed->setName($name);
		$personInNeed->setSurname($surname);
		$personInNeed->setPin($pin);
		$personInNeed->setReason($reason);
		
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