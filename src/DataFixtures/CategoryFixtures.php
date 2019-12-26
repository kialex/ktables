<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class CategoryFixtures
 * @package App\DataFixtures
 */
class CategoryFixtures extends Fixture
{
    const CAT_1 = 'cat_1';
    const CAT_2 = 'cat_2';
    const CAT_3 = 'cat_3';
    const CAT_4 = 'cat_4';

    /**
     * @var array
     */
    private $categories = [
        self::CAT_1 => [
            'title' => 'Кухонные столы',
            'level' => 0
        ],
        self::CAT_2 => [
            'title' => 'Обеденные столы',
            'level' => 0
        ],
        self::CAT_3 => [
            'title' => 'Журнальные столы',
            'level' => 0
        ],
        self::CAT_4 => [
            'title' => 'Эксклюзивные столы',
            'level' => 0
        ],
    ];

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->categories as $nameReference => $category) {
            $categoryEntity = new Category();
            $categoryEntity
                ->setTitle($category['title'])
                ->setLevel($category['level'] ?? 0)
                ->setCreatedAt(new \DateTime());
            $manager->persist($categoryEntity);
            $manager->flush();
            $this->setReference($nameReference, $categoryEntity);
        }
    }
}