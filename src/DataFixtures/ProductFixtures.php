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
        // Круглый классический стол
        [
            'title' => 'Круглый классический стол (Орех)',
            'price' => 3400,
            'sku' => 'KK090904210',
            'short_description' => 'Краткое описание',
            'description' => 'Длинное описание',
            'is_active' => 1,
            'category' => [CategoryFixtures::CAT_1, CategoryFixtures::CAT_2]
        ],
        [
            'title' => 'Круглый классический стол (Итальянский Орех)',
            'price' => 3400,
            'sku' => 'KK090904244',
            'short_description' => 'Краткое описание',
            'description' => 'Длинное описание',
            'is_active' => 1,
            'category' => [CategoryFixtures::CAT_1, CategoryFixtures::CAT_2]
        ],
        [
            'title' => 'Круглый классический стол (Белый)',
            'price' => 3400,
            'sku' => 'KK090904233',
            'short_description' => 'Краткое описание',
            'description' => 'Длинное описание',
            'is_active' => 1,
            'category' => [CategoryFixtures::CAT_1, CategoryFixtures::CAT_2]
        ],
        [
            'title' => 'Круглый классический стол (Слоновая Кость)',
            'price' => 3400,
            'sku' => 'KK090904222',
            'short_description' => 'Краткое описание',
            'description' => 'Длинное описание',
            'is_active' => 1,
            'category' => [CategoryFixtures::CAT_1, CategoryFixtures::CAT_2]
        ],
        [
            'title' => 'Круглый классический стол (Ваниль)',
            'price' => 3400,
            'sku' => 'KK090904211',
            'short_description' => 'Краткое описание',
            'description' => 'Длинное описание',
            'is_active' => 1,
            'category' => [CategoryFixtures::CAT_1, CategoryFixtures::CAT_2]
        ],
        [
            'title' => 'Круглый классический стол (Натуральный)',
            'price' => 3400,
            'sku' => 'KK090904200',
            'short_description' => 'Краткое описание',
            'description' => 'Длинное описание',
            'is_active' => 1,
            'category' => [CategoryFixtures::CAT_1, CategoryFixtures::CAT_2]
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
                ->setInStock($product['in_stock'] ?? 1)
                ->setCreatedAt(new \DateTime());
            if (isset($product['category']) && is_array($product['category'])) {
                foreach ($product['category'] as $category) {
                    if ($this->hasReference($category)) {
                        /** @var Category $category */
                        $category = $this->getReference($category);
                        $entityProduct->addCategory($category);
                    }
                }
            }

            $manager->persist($entityProduct);
            $manager->flush();
        }
    }
}
