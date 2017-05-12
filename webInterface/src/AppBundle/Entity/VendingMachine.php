<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VendingMachineRepository")
 * @ORM\Table(name="vending_machine")
 */
class VendingMachine 
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string",name="machine_name",length=140)
	 */
	private $machine_name;
	
	/**
	 * @ORM\Column(type="string",name="key",length=140)
	 */
	private $key;
	
	/**
	 * @ORM\Column(type="string",name="secret",length=255)
	 */
	private $secret;

	/**
	 * @var string
	 * Sometimes in our web/cli interface we may need to provide the key into unhashed form
	 */
	private $unhashedSecret;
	
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
     * Set machineName
     *
     * @param string $machineName
     *
     * @return VendingMachine
     */
    public function setMachineName($machineName)
    {
        $this->machine_name = $machineName;

        return $this;
    }

    /**
     * Get machineName
     *
     * @return string
     */
    public function getMachineName()
    {
        return $this->machine_name;
    }

    /**
     * Set key
     *
     * @param string $key
     *
     * @return VendingMachine
     */
    public function setKey($key)
    {
    	
        $this->key = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set secret
     *
     * @param string $secret
     *
     * @return VendingMachine
     */
    public function setSecret($secret)
    {
    	$this->unhashedSecret=$secret;
    	//Storing in a secure way
        $this->secret = password_hash($secret,PASSWORD_BCRYPT);

        return $this;
    }

    /**
     * Get secret
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }
    
    public function getSecretUnhashed()
    {
    	return $this->unhashedSecret;
    }
}
