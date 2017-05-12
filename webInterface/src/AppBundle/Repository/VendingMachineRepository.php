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
	public function resisterANewVendingMachineUsingName($name)
	{
		
	}
}