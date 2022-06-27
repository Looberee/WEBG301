<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantities;

    /**
     * @ORM\OneToMany(targetEntity=TransactionReports::class, mappedBy="Order_ID")
     */
    private $Order_ID;

    public function __construct()
    {
        $this->Order_ID = new ArrayCollection();
    }

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

    public function getQuantities(): ?int
    {
        return $this->Quantities;
    }

    public function setQuantities(int $Quantities): self
    {
        $this->Quantities = $Quantities;

        return $this;
    }

    /**
     * @return Collection<int, TransactionReports>
     */
    public function getOrderID(): Collection
    {
        return $this->Order_ID;
    }

    public function addOrderID(TransactionReports $orderID): self
    {
        if (!$this->Order_ID->contains($orderID)) {
            $this->Order_ID[] = $orderID;
            $orderID->setOrderID($this);
        }

        return $this;
    }

    public function removeOrderID(TransactionReports $orderID): self
    {
        if ($this->Order_ID->removeElement($orderID)) {
            // set the owning side to null (unless already changed)
            if ($orderID->getOrderID() === $this) {
                $orderID->setOrderID(null);
            }
        }

        return $this;
    }

}
