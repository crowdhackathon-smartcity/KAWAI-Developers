<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\PersonInNeed;
use AppBundle\Entity\VendingMachine;


/**
 * @ORM\Entity(repository="AppBundle\Repository\PersonInNeedPerVendingRepository")
 * @ORM\Table(name="person_per_vending")
 */
class PersonInNeedPerVending 
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\OneToOne(targetEntity="PersonInNeed")
	 * @ORM\JoinColumn(name="person_in_need_id", referencedColumnName="id")
	 */
	private $personInNeed;
	
	/**
	 * @ORM\OneToOne(targetEntity="VendingMachine")
	 * @ORM\JoinColumn(name="vending_machine_id", referencedColumnName="id")
	 */
	private $vending_machine;
	
	/**
	 * @ORM\Column(type="date",type="date")
	 */
	private $date;
	
	/**
	 * @PrePersist
	 */
	public function onPrePersistSetRegistrationDate()
	{
		$this->date = new \DateTime();
	}

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set personInNeed
     *
     * @param \AppBundle\Entity\PersonInNeed $personInNeed
     *
     * @return PersonInNeedPerVending
     */
    public function setPersonInNeed(\AppBundle\Entity\PersonInNeed $personInNeed = null)
    {
        $this->personInNeed = $personInNeed;

        return $this;
    }

    /**
     * Get personInNeed
     *
     * @return \AppBundle\Entity\PersonInNeed
     */
    public function getPersonInNeed()
    {
        return $this->personInNeed;
    }

    /**
     * Set vendingMachine
     *
     * @param \AppBundle\Entity\VendingMachine $vendingMachine
     *
     * @return PersonInNeedPerVending
     */
    public function setVendingMachine(\AppBundle\Entity\VendingMachine $vendingMachine = null)
    {
        $this->vending_machine = $vendingMachine;

        return $this;
    }

    /**
     * Get vendingMachine
     *
     * @return \AppBundle\Entity\VendingMachine
     */
    public function getVendingMachine()
    {
        return $this->vending_machine;
    }
    
    /**
     * @return \DateTime
     */
    public function getDate()
    {
    	return $this->date;
    }
}
