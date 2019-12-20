<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new Admin();
        $user
            ->setEmail('admin@admin.com')
            ->setRoles(['ROLE_SUPER_ADMIN']);

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'admin'
        ));

        $manager->persist($user);
        $manager->flush();
    }
}
