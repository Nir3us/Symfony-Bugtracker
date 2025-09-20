<?php

/**
 * This file is part of the Symfony Bugtracker project.
 *
 * Service class for handling Bug-related business logic.
 *
 * (c)Norbert Białek <mlodszy.bialek@gmail.com>
 */

namespace App\Service;

use App\Entity\Bug;
use App\Repository\BugRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class BugService
{
    public function __construct(
        private EntityManagerInterface $em,
        private BugRepository $bugRepository,
        private PaginatorInterface $paginator,
    ) {
    }

    public function getPaginatedBugs(int $page, int $limit = 10)
    {
        $query = $this->bugRepository->createQueryBuilder('bug')
            ->leftJoin('bug.reporter', 'reporter')->addSelect('reporter')
            ->leftJoin('bug.project', 'project')->addSelect('project')
            ->orderBy('bug.createdAt', 'DESC')
            ->getQuery();

        return $this->paginator->paginate($query, $page, $limit);
    }

    public function create(Bug $bug): void
    {
        $this->em->persist($bug);
        $this->em->flush();
    }

    public function update(): void
    {
        $this->em->flush();
    }

    public function delete(Bug $bug): void
    {
        $this->em->remove($bug);
        $this->em->flush();
    }
}
