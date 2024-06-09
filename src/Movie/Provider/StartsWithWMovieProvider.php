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

use function array_values;
use function mb_strlen;

class StartsWithWMovieProvider extends AbstractMovieProvider
{
    public function getMovies(): array
    {
        $validMovies = array_filter($this->getAllMovies(), function ($movie) {
            return mb_stripos($movie, 'W') === 0 && (mb_strlen($movie) % 2 === 0);
        });

        return array_values($validMovies);
    }

    public function getType(): ProviderTypeEnum
    {
        return ProviderTypeEnum::StartsWithWMovie;
    }
}
