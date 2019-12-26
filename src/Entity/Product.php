<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private $sku;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $price;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $short_description;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default":1})
     */
    private $in_stock;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default":1})
     */
    private $is_active;

    /**
     * @var string
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="products")
     */
    private $categories;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * @param Category $category
     * @return Product
     */
    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }
        return $this;
    }

    /**
     * @param Category $category
     * @return Product
     */
    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param \DateTimeInterface $created_at
     * @return Product
     */
    public function setCreatedAt(\DateTimeInterface $created_at): Product
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     * @return Product
     */
    public function setSku(string $sku): Product
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Product
     */
    public function setTitle(string $title): Product
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Product
     */
    public function setPrice(float $price): Product
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortDescription(): string
    {
        return $this->short_description;
    }

    /**
     * @param string $short_description
     * @return Product
     */
    public function setShortDescription(string $short_description): Product
    {
        $this->short_description = $short_description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Product
     */
    public function setDescription(string $description): Product
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIsActive(): bool
    {
        return $this->is_active;
    }

    /**
     * @return bool
     */
    public function isInStock(): bool
    {
        return $this->in_stock;
    }

    /**
     * @param bool $in_stock
     * @return Product
     */
    public function setInStock(bool $in_stock): Product
    {
        $this->in_stock = $in_stock;
        return $this;
    }

    /**
     * @param bool $is_active
     * @return Product
     */
    public function setIsActive(bool $is_active): Product
    {
        $this->is_active = $is_active;
        return $this;
    }
}
