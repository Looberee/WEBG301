<?php

namespace App\Entity;

use App\Repository\FoodSupplyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FoodSupplyRepository::class)
 */
class FoodSupply
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
     * @ORM\Column(type="integer")
     */
    private $Quantity_Supply;

    /**
     * @ORM\Column(type="date")
     */
    private $Date_Supply;

    /**
     * @ORM\OneToMany(targetEntity=TransactionReports::class, mappedBy="Supply_ID")
     */
    private $Supply_ID;

    public function __construct()
    {
        $this->Supply_ID = new ArrayCollection();
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

    public function getQuantitySupply(): ?int
    {
        return $this->Quantity_Supply;
    }

    public function setQuantitySupply(int $Quantity_Supply): self
    {
        $this->Quantity_Supply = $Quantity_Supply;

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

    public function addSupplyID(TransactionReports $supplyID): self
    {
        if (!$this->Supply_ID->contains($supplyID)) {
            $this->Supply_ID[] = $supplyID;
            $supplyID->setSupplyID($this);
        }

        return $this;
    }

    public function removeSupplyID(TransactionReports $supplyID): self
    {
        if ($this->Supply_ID->removeElement($supplyID)) {
            // set the owning side to null (unless already changed)
            if ($supplyID->getSupplyID() === $this) {
                $supplyID->setSupplyID(null);
            }
        }

        return $this;
    }
    public function __ToString()
    {
        return (string)$this->getId();
    }
}
