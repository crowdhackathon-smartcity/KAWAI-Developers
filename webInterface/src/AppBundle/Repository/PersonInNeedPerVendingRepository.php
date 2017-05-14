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
		$em=$this->getEntityManager();
		
		$entity=new PersonInNeedPerVending();
		
		$entity->setPersonInNeed($person);
		$entity->setVendingMachine($machine);
		
		$em->persist($entity);
		$em->flush($entity);
		
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
			->join('pvm.personInNeed','p')
			->join('pvm.vending_machine','v')
			->select('MAX(pvm.date) as date');
		
		$qb->andWhere('p.id=:person_in_need')->setParameter(':person_in_need', $person->getId());
		$qb->andWhere('v.id=:vending_machine')->setParameter(':vending_machine', $machine->getId());
		
		$query=$qb->getQuery();
		return $query->getSingleResult();
	}
}