<?php

namespace App\Security;

use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\InvalidPayloadException;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\UserNotFoundException;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\PayloadAwareUserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;

class JwtPayloadUserProvider implements PayloadAwareUserProviderInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @inheritDoc
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @inheritDoc
     */
    public function loadUserByUsernameAndPayload($username, array $payload)
    {
        if (!isset($payload['class'])) {
            throw new InvalidPayloadException('Payload has not "class" key');
        }

        if (!in_array(UserInterface::class, (array)class_implements($payload['class']))) {
            throw new UnsupportedUserException(sprintf('Invalid user class "%s".', $payload['class']));
        }

        $user = $this->manager->getRepository($payload['class'])->findOneBy(['email' => $username]);
        if (!$user) {
            throw new UserNotFoundException('email', $payload['class']);
        }

        return $user;
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function refreshUser(UserInterface $user)
    {
        throw new \Exception('Unnecessary method for JWT Token Authenticator');
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function loadUserByUsername(string $username)
    {
        throw new \Exception('Unnecessary method for JWT Token Authenticator');
    }

    /**
     * @inheritDoc
     */
    public function supportsClass(string $class)
    {
        return true;
    }
}
