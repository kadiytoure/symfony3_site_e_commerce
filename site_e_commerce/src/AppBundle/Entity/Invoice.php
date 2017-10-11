<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @ORM\Table(name="invoice")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InvoiceRepository")
 */
class Invoice
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
     * @ORM\Column(name="numberfacture", type="integer")
     */
    private $numberfacture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateoffacture", type="date")
     */
    private $dateoffacture;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;


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
     * Set numberfacture
     *
     * @param integer $numberfacture
     *
     * @return Invoice
     */
    public function setNumberfacture($numberfacture)
    {
        $this->numberfacture = $numberfacture;

        return $this;
    }

    /**
     * Get numberfacture
     *
     * @return int
     */
    public function getNumberfacture()
    {
        return $this->numberfacture;
    }

    /**
     * Set dateoffacture
     *
     * @param \DateTime $dateoffacture
     *
     * @return Invoice
     */
    public function setDateoffacture($dateoffacture)
    {
        $this->dateoffacture = $dateoffacture;

        return $this;
    }

    /**
     * Get dateoffacture
     *
     * @return \DateTime
     */
    public function getDateoffacture()
    {
        return $this->dateoffacture;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Invoice
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }
}

