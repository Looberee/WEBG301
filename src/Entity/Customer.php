<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Customer_Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Gender;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="CustomerID")
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity=Delivery::class, mappedBy="Customer_ID")
     */
    private $deliveries;

    /**
     * @ORM\OneToMany(targetEntity=TransactionReports::class, mappedBy="Customer_ID")
     */
    private $Customer_ID;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->deliveries = new ArrayCollection();
        $this->Customer_ID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerName(): ?string
    {
        return $this->Customer_Name;
    }

    public function setCustomerName(string $Customer_Name): self
    {
        $this->Customer_Name = $Customer_Name;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->Gender;
    }

    public function setGender(string $Gender): self
    {
        $this->Gender = $Gender;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setCustomerID($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getCustomerID() === $this) {
                $order->setCustomerID(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return (string)$this->getCustomerName();
    }

    /**
     * @return Collection<int, Delivery>
     */
    public function getDeliveries(): Collection
    {
        return $this->deliveries;
    }

    public function addDelivery(Delivery $delivery): self
    {
        if (!$this->deliveries->contains($delivery)) {
            $this->deliveries[] = $delivery;
            $delivery->setCustomerID($this);
        }

        return $this;
    }

    public function removeDelivery(Delivery $delivery): self
    {
        if ($this->deliveries->removeElement($delivery)) {
            // set the owning side to null (unless already changed)
            if ($delivery->getCustomerID() === $this) {
                $delivery->setCustomerID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TransactionReports>
     */
    public function getCustomerID(): Collection
    {
        return $this->Customer_ID;
    }

    public function addCustomerID(TransactionReports $customerID): self
    {
        if (!$this->Customer_ID->contains($customerID)) {
            $this->Customer_ID[] = $customerID;
            $customerID->setCustomerID($this);
        }

        return $this;
    }

    public function removeCustomerID(TransactionReports $customerID): self
    {
        if ($this->Customer_ID->removeElement($customerID)) {
            // set the owning side to null (unless already changed)
            if ($customerID->getCustomerID() === $this) {
                $customerID->setCustomerID(null);
            }
        }

        return $this;
    }
}
