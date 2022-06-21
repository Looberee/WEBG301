<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Order_Date;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CustomerID;

    /**
     * @ORM\ManyToOne(targetEntity=Food::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $FoodID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->Order_Date;
    }

    public function setOrderDate(\DateTimeInterface $Order_Date): self
    {
        $this->Order_Date = $Order_Date;

        return $this;
    }

    public function getCustomerID(): ?Customer
    {
        return $this->CustomerID;
    }

    public function setCustomerID(?Customer $CustomerID): self
    {
        $this->CustomerID = $CustomerID;

        return $this;
    }

    public function getFoodID(): ?Food
    {
        return $this->FoodID;
    }

    public function setFoodID(?Food $FoodID): self
    {
        $this->FoodID = $FoodID;

        return $this;
    }
    public function __toString()
    {
        return (string)$this->getOrderDate();
    }
}
