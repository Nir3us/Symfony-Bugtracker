<?php

/*
 * This file is part of the Symfony Bugtracker project.
 *
 * This document allows me to set standard time for my whole project
 *
 * (c)Norbert Białek <mlodszy.bialek@gmail.com>
 */

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('app_date', [$this, 'formatDate']),
        ];
    }

    public function formatDate(?\DateTimeInterface $date): string
    {
        if (!$date) {
            return '';
        }

        return $date->format('d.m.Y H:i');
    }
}
