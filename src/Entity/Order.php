<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;


/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     */
    private $id;

    public function getId(): ?string
    {
        return $this->id;
    }

	public function setId($id){
		$this->id = $id;
    }
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="order")
     */
    private $produits;

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }
    public function addProduits(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setArticle($this);
        }
        return $this;
    }
    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getOrder() === $this) {
                $produit->setOrder(null);
            }
        }
        return $this;
    }
}