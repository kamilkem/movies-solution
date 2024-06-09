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
use function str_word_count;

class MultiWordMovieProvider extends AbstractMovieProvider
{
    /**
     * @return string[]
     */
    public function getMovies(): array
    {
        $validMovies = array_filter($this->getAllMovies(), function ($movie) {
            return str_word_count($movie) > 1;
        });

        return array_values($validMovies);
    }

    public function getType(): ProviderTypeEnum
    {
        return ProviderTypeEnum::MultiWordMovie;
    }
}
