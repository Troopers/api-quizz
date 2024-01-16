<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function getRoles(): array
    {
        return ['ROLE_ADMIN'];
    }

    public function eraseCredentials()
    {

    }

    public function getPassword(): ?string
    {
        return '$2y$13$Zw2cxhlzLg7hEZqVSDxWa.bh0CRD87DQmrSRMJYuAhF8mBP3S83Ay';
    }

    public function getUserIdentifier(): string
    {
        return 'admin';
    }
}
