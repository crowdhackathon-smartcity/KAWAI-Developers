<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonInNeedRepository")
 * @ORM\Table(name="person_in_need")
 * @UniqueEntity("pin")
 */
class PersonInNeed 
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * The reason why person is in need
	 * @ORM\Column(type="text",name="reason")
	 */
	private $reason;
	
	/**
	 * The name of the person in need
	 * @ORM\Column(type="string",name="name",length=80)
	 */
	private $name;
	
	/**
	 * The name of the person in need
	 * @ORM\Column(type="string",name="surname",length=80)
	 */
	private $surname;
	
	
	/**
	 * A secret Pin in order to use it as authentication
	 * @ORM\Column(type="string",name="pin",unique = true,length=4)
	 */
	private $pin;
	

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
     * Set reason
     *
     * @param integer $reason
     *
     * @return PersonInNeed
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return integer
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return PersonInNeed
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return PersonInNeed
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set pin
     *
     * @param string $pin
     *
     * @return PersonInNeed
     */
    public function setPin($pin)
    {
        $this->pin =$pin;

        return $this;
    }

    /**
     * Get pin
     *
     * @return string
     */
    public function getPin()
    {
        return $this->pin;
    }
    
}
