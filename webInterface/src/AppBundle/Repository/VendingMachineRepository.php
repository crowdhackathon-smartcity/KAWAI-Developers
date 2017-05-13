<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\VendingMachine;

class VendingMachineRepository extends EntityRepository
{
	/** 
	 * @param string $name
	 * @return VendingMachine
	 */
	public function resisterANewVendingMachine($name,$key,$secret)
	{
		$em=$this->getEntityManager();
		
		$entity=new VendingMachine();
		
		$entity->setMachineName($name);
		$entity->setKey($key);
		$entity->setSecret($secret);
		
		$em->persist($entity);
		$em->flush($entity);
		
		return $entity;
	}
	
	public function getVendingMachineByKey($key)
	{
		$qb=$this->createQueryBuilder('v')
				->from('AppBundle:VendingMachine')
				->where('key=:key');
		
		$qb->setParameter('key', $key);
		
		$query = $query->getQuery();
		
		return $query->getOneOrNullResult();
	}
}