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

use function array_flip;
use function array_rand;

class RandomMovieProvider extends AbstractMovieProvider
{
    private const int COUNT_RANDOM_MOVIES = 3;

    /**
     * @return string[]
     */
    public function getMovies(): array
    {
        $allMovies = $this->getAllMovies();

        if (empty($allMovies)) {
            return [];
        }

        return array_rand(array_flip($allMovies), self::COUNT_RANDOM_MOVIES);
    }

    public function getType(): ProviderTypeEnum
    {
        return ProviderTypeEnum::RandomMovie;
    }
}
