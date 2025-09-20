<?php

/**
 * This file is part of the Symfony Bugtracker project.
 *
 * Rector configuration file.
 *
 * It defines paths and rules for automated code refactoring.
 *
 * (c) Norbert Białek <mlodszy.bialek@gmail.com>
 * Licensed under MIT License. See LICENSE file for details.
 */
declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/assets',
        __DIR__.'/config',
        __DIR__.'/public',
        __DIR__.'/src',
        __DIR__.'/tests',
    ])
    // uncomment to reach your current PHP version
    // ->withPhpSets()
    ->withTypeCoverageLevel(0)
    ->withDeadCodeLevel(0)
    ->withCodeQualityLevel(0);
