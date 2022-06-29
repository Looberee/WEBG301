<?php

namespace App\Entity;

use App\Repository\TransactionReportsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransactionReportsRepository::class)
 */
class TransactionReports
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="Order_ID")
     */
    private $Order_ID;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="Customer_ID")
     */
    private $Customer_ID;

    /**
     * @ORM\ManyToOne(targetEntity=Food::class, inversedBy="Food_ID")
     */
    private $Food_ID;

    /**
     * @ORM\ManyToOne(targetEntity=FoodSupply::class, inversedBy="Supply_ID")
     */
    private $Supply_ID;

    /**
     * @ORM\ManyToOne(targetEntity=Delivery::class, inversedBy="Delivery_ID")
     */
    private $Delivery_ID;

    /**
     * @ORM\Column(type="date")
     */
    private $Date_Supply;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderID(): ?Order
    {
        return $this->Order_ID;
    }

    public function setOrderID(?Order $Order_ID): self
    {
        $this->Order_ID = $Order_ID;

        return $this;
    }

    public function getCustomerID(): ?Customer
    {
        return $this->Customer_ID;
    }

    public function setCustomerID(?Customer $Customer_ID): self
    {
        $this->Customer_ID = $Customer_ID;

        return $this;
    }

    public function getFoodID(): ?Food
    {
        return $this->Food_ID;
    }

    public function setFoodID(?Food $Food_ID): self
    {
        $this->Food_ID = $Food_ID;

        return $this;
    }

    public function getSupplyID(): ?FoodSupply
    {
        return $this->Supply_ID;
    }

    public function setSupplyID(?FoodSupply $Supply_ID): self
    {
        $this->Supply_ID = $Supply_ID;

        return $this;
    }

    public function getDeliveryID(): ?Delivery
    {
        return $this->Delivery_ID;
    }

    public function setDeliveryID(?Delivery $Delivery_ID): self
    {
        $this->Delivery_ID = $Delivery_ID;

        return $this;
    }

    public function getDateSupply(): ?\DateTimeInterface
    {
        return $this->Date_Supply;
    }

    public function setDateSupply(\DateTimeInterface $Date_Supply): self
    {
        $this->Date_Supply = $Date_Supply;

        return $this;
    }
    public function __toString()
    {
        return (string)$this->getDateSupply();
    }
}
