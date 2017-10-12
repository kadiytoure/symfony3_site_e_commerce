<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shipment
 *
 * @ORM\Table(name="shipment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShipmentRepository")
 */
class Shipment
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
     * @var int
     *
     * @ORM\Column(name="numberlivraison", type="integer")
     */
    private $numberlivraison;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateshipment", type="date")
     */
    private $dateshipment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="delivery", type="date")
     */
    private $delivery;
    
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
     * Set numberlivraison
     *
     * @param integer $numberlivraison
     *
     * @return Shipment
     */
    public function setNumberlivraison($numberlivraison)
    {
        $this->numberlivraison = $numberlivraison;

        return $this;
    }

    /**
     * Get numberlivraison
     *
     * @return int
     */
    public function getNumberlivraison()
    {
        return $this->numberlivraison;
    }

    /**
     * Set dateshipment
     *
     * @param \DateTime $dateshipment
     *
     * @return Shipment
     */
    public function setDateshipment($dateshipment)
    {
        $this->dateshipment = $dateshipment;

        return $this;
    }

    /**
     * Get dateshipment
     *
     * @return \DateTime
     */
    public function getDateshipment()
    {
        return $this->dateshipment;
    }

    /**
     * Set delivery
     *
     * @param \DateTime $delivery
     *
     * @return Shipment
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * Get delivery
     *
     * @return \DateTime
     */
    public function getDelivery()
    {
        return $this->delivery;
    }
    
    /**
     * One Shipment has One Command.
     * @ORM\OneToOne(targetEntity="Commands")
     * @ORM\JoinColumn(name="commands_id", referencedColumnName="id")
     */
    
    private $commands;
}

