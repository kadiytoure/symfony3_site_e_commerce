<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandLine
 *
 * @ORM\Table(name="command_line")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommandLineRepository")
 */
class CommandLine
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
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="Commands", inversedBy="commandline")
     * @ORM\JoinColumn(name="commands_id", referencedColumnName="id")
     */
    private $commands;
    
    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="commandline")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return CommandLine
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return CommandLine
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
    


    /**
     * Set commands
     *
     * @param \AppBundle\Entity\Commands $commands
     *
     * @return CommandLine
     */
    public function setCommands(\AppBundle\Entity\Commands $commands = null)
    {
        $this->commands = $commands;

        return $this;
    }

    /**
     * Get commands
     *
     * @return \AppBundle\Entity\Commands
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return CommandLine
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
