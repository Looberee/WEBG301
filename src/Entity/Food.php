<?php

namespace App\Entity;

use App\Repository\FoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FoodRepository::class)
 */
class Food
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
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="FoodID")
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity=Delivery::class, mappedBy="Food_ID")
     */
    private $deliveries;

    /**
     * @ORM\OneToMany(targetEntity=TransactionReports::class, mappedBy="Food_ID")
     */
    private $Food_ID;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->deliveries = new ArrayCollection();
        $this->Food_ID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
            $order->setFoodID($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getFoodID() === $this) {
                $order->setFoodID(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return (string)$this->getName();
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
            $delivery->setFoodID($this);
        }

        return $this;
    }

    public function removeDelivery(Delivery $delivery): self
    {
        if ($this->deliveries->removeElement($delivery)) {
            // set the owning side to null (unless already changed)
            if ($delivery->getFoodID() === $this) {
                $delivery->setFoodID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TransactionReports>
     */
    public function getFoodID(): Collection
    {
        return $this->Food_ID;
    }

    public function addFoodID(TransactionReports $foodID): self
    {
        if (!$this->Food_ID->contains($foodID)) {
            $this->Food_ID[] = $foodID;
            $foodID->setFoodID($this);
        }

        return $this;
    }

    public function removeFoodID(TransactionReports $foodID): self
    {
        if ($this->Food_ID->removeElement($foodID)) {
            // set the owning side to null (unless already changed)
            if ($foodID->getFoodID() === $this) {
                $foodID->setFoodID(null);
            }
        }

        return $this;
    }
}
