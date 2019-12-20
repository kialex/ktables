<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CustomerFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new Customer();
        $user
            ->setEmail('admin-customer@customer.com')
            ->setRoles(['ROLE_CUSTOMER']);

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'qwerty'
        ));

        $manager->persist($user);
        $manager->flush();
    }
}
