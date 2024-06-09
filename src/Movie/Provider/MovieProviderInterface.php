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

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(name: 'movie_provider')]
interface MovieProviderInterface
{
    /**
     * @return string[]
     */
    public function getMovies(): array;

    public function getType(): ProviderTypeEnum;
}
