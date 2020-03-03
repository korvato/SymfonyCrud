<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     */
    private $ref;

    /**
     * @ORM\Column(type="string")
     */
    private $label;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order;

    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getRef(){
		return $this->ref;
	}

	public function setRef($ref){
		$this->ref = $ref;
	}

	public function getLabel(){
		return $this->label;
	}

	public function setLabel($label){
		$this->label = $label;
	}

	public function getPrice(){
		return $this->price;
	}

	public function setPrice($price){
		$this->price = $price;
    }
    
    public function getOrder(){
		return $this->order;
	}

	public function setOrder($order){
		$this->order = $order;
    }
    
    public function getUser(){
		return $this->user;
	}

	public function setUser($user){
		$this->user = $user;
	}
}
