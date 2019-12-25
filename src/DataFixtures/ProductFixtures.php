<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class ProductCategoryFixtures
 * @package App\DataFixtures
 */
class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var array
     */
    private $products = [
        [
            'title' => 'Гермес (Орех)',
            'price' => 3400,
            'sku' => 'GT09009042',
            'short_description' => 'Краткое описание',
            'description' => 'Длинное описание',
            'is_active' => 1,
            'category' => CategoryFixtures::CAT_1
        ],
        [
            'title' => 'Гермес (Итальянский Орех)',
            'price' => 3400,
            'sku' => 'OT09009042',
            'short_description' => 'Краткое описание',
            'description' => 'Длинное описание',
            'is_active' => 1,
            'category' => CategoryFixtures::CAT_1
        ],
        [
            'title' => 'Гермес (Белый)',
            'price' => 3400,
            'sku' => 'WT09009042',
            'short_description' => 'Краткое описание',
            'description' => 'Длинное описание',
            'is_active' => 1,
            'category' => CategoryFixtures::CAT_1
        ],
        [
            'title' => 'Гермес (Слоновая Кость)',
            'price' => 3400,
            'sku' => 'KT09009042',
            'short_description' => 'Краткое описание',
            'description' => 'Длинное описание',
            'is_active' => 1,
            'category' => CategoryFixtures::CAT_1
        ],
        [
            'title' => 'Гермес (Ваниль Кость)',
            'price' => 3400,
            'sku' => 'VT09009042',
            'short_description' => 'Краткое описание',
            'description' => 'Длинное описание',
            'is_active' => 1,
            'category' => CategoryFixtures::CAT_1
        ],
    ];

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->products as $product) {
            $entityProduct = new Product();
            $entityProduct
                ->setTitle($product['title'])
                ->setSku($product['sku'])
                ->setPrice($product['price'])
                ->setShortDescription($product['short_description'] ?? null)
                ->setDescription($product['description'] ?? null)
                ->setIsActive($product['is_active'] ?? 1)
                ->setCreatedAt(new \DateTime());
            if (isset($product['category']) && $this->hasReference($product['category'])) {
                /** @var Category $category */
                $category = $this->getReference($product['category']);
                $entityProduct->addCategory($category);
            }

            $manager->persist($entityProduct);
            $manager->flush();
        }
    }
}
