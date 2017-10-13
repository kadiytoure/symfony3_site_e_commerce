<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commands
 *
 * @ORM\Table(name="commands")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommandsRepository")
 */
class Commands
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecommand", type="datetime")
     */
    private $datecommand;

    /**
     * @var int
     *
     * @ORM\Column(name="numbercommand", type="integer")
     */
    private $numbercommand;

    /**
     * @var bool
     *
     * @ORM\Column(name="cart", type="boolean")
     */
    private $cart;
    
    /**
     * @ORM\OneToOne(targetEntity="Shipment")
     * @ORM\JoinColumn(name="shipment_id", referencedColumnName="id")
     */
    private $shipment;
    
    /**
     * @ORM\OneToMany(targetEntity="CommandLine", mappedBy="commands")
     */
    private $commandline;
 
    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="commands")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datecommand
     *
     * @param \DateTime $datecommand
     *
     * @return Commands
     */
    public function setDatecommand($datecommand)
    {
        $this->datecommand = $datecommand;

        return $this;
    }

    /**
     * Get datecommand
     *
     * @return \DateTime
     */
    public function getDatecommand()
    {
        return $this->datecommand;
    }

    /**
     * Set idcommand
     *
     * @param integer $idcommand
     *
     * @return Commands
     */
    public function setIdcommand($idcommand)
    {
        $this->idcommand = $idcommand;

        return $this;
    }

    /**
     * Get idcommand
     *
     * @return int
     */
    public function getIdcommand()
    {
        return $this->idcommand;
    }

    /**
     * Set numbercommand
     *
     * @param integer $numbercommand
     *
     * @return Commands
     */
    public function setNumbercommand($numbercommand)
    {
        $this->numbercommand = $numbercommand;

        return $this;
    }

    /**
     * Get numbercommand
     *
     * @return int
     */
    public function getNumbercommand()
    {
        return $this->numbercommand;
    }

    /**
     * Set cart
     *
     * @param boolean $cart
     *
     * @return Commands
     */
    public function setCart($cart)
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * Get cart
     *
     * @return bool
     */
    public function getCart()
    {
        return $this->cart;
    }
    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commandline = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set shipment
     *
     * @param \AppBundle\Entity\Shipment $shipment
     *
     * @return Commands
     */
    public function setShipment(\AppBundle\Entity\Shipment $shipment = null)
    {
        $this->shipment = $shipment;

        return $this;
    }

    /**
     * Get shipment
     *
     * @return \AppBundle\Entity\Shipment
     */
    public function getShipment()
    {
        return $this->shipment;
    }

    /**
     * Add commandline
     *
     * @param \AppBundle\Entity\CommandLine $commandline
     *
     * @return Commands
     */
    public function addCommandline(\AppBundle\Entity\CommandLine $commandline)
    {
        $this->commandline[] = $commandline;

        return $this;
    }

    /**
     * Remove commandline
     *
     * @param \AppBundle\Entity\CommandLine $commandline
     */
    public function removeCommandline(\AppBundle\Entity\CommandLine $commandline)
    {
        $this->commandline->removeElement($commandline);
    }

    /**
     * Get commandline
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommandline()
    {
        return $this->commandline;
    }

    /**
     * Set customer
     *
     * @param \AppBundle\Entity\Customer $customer
     *
     * @return Commands
     */
    public function setCustomer(\AppBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \AppBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
