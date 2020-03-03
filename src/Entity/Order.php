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

    /**
     * @ORM\Column(type="string")
     */
    private $marketplace;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function getId(): ?string
    {
        return $this->id;
    }
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="order")
     */
    private $produits;

	public function setId($id){
		$this->id = $id;
    }
    
    public function getMarketplace(){
		return $this->marketplace;
	}

	public function setMarketplace($marketplace){
		$this->marketplace = $marketplace;
	}

	public function getCreated_at(){
		return $this->created_at;
	}

	public function setCreated_at($created_at){
		$this->created_at = $created_at;
    }

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