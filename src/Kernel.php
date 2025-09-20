<?php

/**
 * This file is part of the Symfony Bugtracker project.
 *
 * The application Kernel is the main entry point for configuring
 * bundles and handling the Symfony runtime.
 *
 * (c) Norbert Białek <mlodszy.bialek@gmail.com>
 * Licensed under MIT License.
 */

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}
