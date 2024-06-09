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

namespace App\Movie\Provider\Registry;

use App\Movie\Provider\MovieProviderInterface;
use App\Movie\Provider\ProviderTypeEnum;
use RuntimeException;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

final readonly class MovieProviderRegistry implements MoviesProviderRegistryInterface
{
    /**
     * @param iterable<MovieProviderInterface> $movieProviders
     */
    public function __construct(
        #[AutowireIterator(tag: 'movie_provider')]
        private iterable $movieProviders
    ) {
    }

    public function getProvider(ProviderTypeEnum $type): MovieProviderInterface
    {
        foreach ($this->movieProviders as $provider) {
            if ($provider->getType() === $type) {
                return $provider;
            }
        }

        throw new RuntimeException('Provider not found');
    }
}
