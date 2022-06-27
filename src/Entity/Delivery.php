<?php

namespace App\Entity;

use App\Repository\DeliveryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeliveryRepository::class)
 */
class Delivery
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="deliveries")
     */
    private $Customer_ID;

    /**
     * @ORM\ManyToOne(targetEntity=Food::class, inversedBy="deliveries")
     */
    private $Food_ID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Payment;

    /**
     * @ORM\Column(type="date")
     */
    private $date_delivery;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

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

    public function getPayment(): ?string
    {
        return $this->Payment;
    }

    public function setPayment(string $Payment): self
    {
        $this->Payment = $Payment;

        return $this;
    }

    public function getDateDelivery(): ?\DateTimeInterface
    {
        return $this->date_delivery;
    }

    public function setDateDelivery(\DateTimeInterface $date_delivery): self
    {
        $this->date_delivery = $date_delivery;

        return $this;
    }
}
