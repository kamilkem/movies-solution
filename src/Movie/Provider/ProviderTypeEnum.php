<?php

/**
 * This file is part of the movies-solution package.
 *
 * (c) Kamil Kozaczyński <kozaczynski.kamil@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Movie\Provider;

enum ProviderTypeEnum: string
{
    case RandomMovie = 'random_movie';
    case MultiWordMovie = 'multi_word_movie';
    case StartsWithWMovie = 'starts_with_w_movie';
}
