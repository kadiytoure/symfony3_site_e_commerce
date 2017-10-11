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
     * @ORM\Column(name="idcommand", type="integer")
     */
    private $idcommand;

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
}

