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

namespace App\Controller;

use App\Movie\Provider\ProviderTypeEnum;
use App\Movie\Provider\Registry\MoviesProviderRegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class MovieController extends AbstractController
{
    public function __construct(private readonly MoviesProviderRegistryInterface $moviesProviderRegistry)
    {
    }

    #[Route(path: '/movies/random', methods: ['GET'])]
    public function randomMovies(): JsonResponse
    {
        $provider = $this->moviesProviderRegistry->getProvider(ProviderTypeEnum::RandomMovie);

        return new JsonResponse($provider->getMovies());
    }

    #[Route(path: '/movies/multi-word', methods: ['GET'])]
    public function multiWordMovies(): JsonResponse
    {
        $provider = $this->moviesProviderRegistry->getProvider(ProviderTypeEnum::MultiWordMovie);

        return new JsonResponse($provider->getMovies());
    }

    #[Route(path: '/movies/starts-with-w', methods: ['GET'])]
    public function startsWithWMovies(): JsonResponse
    {
        $provider = $this->moviesProviderRegistry->getProvider(ProviderTypeEnum::StartsWithWMovie);

        return new JsonResponse($provider->getMovies());
    }
}
