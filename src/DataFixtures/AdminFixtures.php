<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * AdminFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $user = new Admin();
        $user
            ->setFirstName('Admin')
            ->setLastName('Admin')
            ->setEmail('admin@admin.com')
            ->setRoles(['ROLE_SUPER_ADMIN'])
            ->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'admin'
            ));

        $manager->persist($user);
        $manager->flush();
    }
}
