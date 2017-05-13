<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\PersonInNeed;
use AppBundle\Entity\VendingMachine;
use AppBundle\Entity\PersonInNeedPerVending;

class PersonInNeedPerVendingRepository extends EntityRepository
{
	/**
	 * @param PersonInNeed $person
	 * @param VendingMachine $machine
	 * @return \AppBundle\Entity\PersonInNeedPerVending
	 */
	public function addPersonPerVending(PersonInNeed $person,VendingMachine $machine)
	{
		$entity=new PersonInNeedPerVending();
		
		$entity->setPersonInNeed($person);
		$entity->setVendingMachine($machine);
		
		$em=$this->getEntityManager();
		$em->flush($entity);
		$em->persist($entity);
		
		return $entity;
	}
	
	/**
	 * @param PersonInNeed $person
	 * @param VendingMachine $machine
	 * @return \DateTime When person used each vending machine
	 */
	public function getLastTimePerdonInNeedUsedVendingMachine(PersonInNeed $person, VendingMachine $machine)
	{
		$qb=$this->getEntityManager()->createQueryBuilder('pvm')
			->from('AppBundle:PersonInNeedPerVending','pvm')
			->select('MAX(pvm.date)');
		
		$qb->andWhere('pvm.personInNeed=:person_in_need')->setParameter('person_in_need', $person);
		$qb->andWhere('pvm.vendingMachine=:vending_machine')->setParameter(':vending_machine', $machine);
		
		$query=$qb->getQuery();
		
		return $query->getOneOrNullResult();
	}
}