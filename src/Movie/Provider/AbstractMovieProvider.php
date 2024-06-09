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

use Exception;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

abstract class AbstractMovieProvider implements MovieProviderInterface
{
    public function __construct(
        #[Autowire(param: 'movies_file_path')]
        private readonly string $moviesFilePath
    ) {
    }

    /**
     * @return string[]
     */
    protected function getAllMovies(): array
    {
        try {
            return require $this->moviesFilePath;
        } catch (Exception) {
            return [];
        }
    }
}
