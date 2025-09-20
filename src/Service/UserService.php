<?php

/**
 * This file is part of the Symfony Bugtracker project.
 *
 * Service class for handling User-related business logic.
 *
 * (c)Norbert Białek <mlodszy.bialek@gmail.com>
 */

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;

class UserService
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function create(User $user): void
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    public function update(User $user): void
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    public function delete(User $user): void
    {
        $this->em->remove($user);
        $this->em->flush();
    }

    public function getUserListQuery(): Query
    {
        return $this->em->getRepository(User::class)
            ->createQueryBuilder('u')
            ->orderBy('u.id', 'DESC')
            ->getQuery();
    }
}
