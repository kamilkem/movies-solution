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

namespace App\Tests\Movie\Provider\Registry;

use App\Movie\Provider\MovieProviderInterface;
use App\Movie\Provider\ProviderTypeEnum;
use App\Movie\Provider\Registry\MovieProviderRegistry;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class MovieProviderRegistryTest extends TestCase
{
    public function testGetProviderReturnsCorrectProvider(): void
    {
        $firstProvider = $this->createMock(MovieProviderInterface::class);
        $firstProvider->expects($this->exactly(2))
            ->method('getType')
            ->willReturn(ProviderTypeEnum::RandomMovie);

        $secondProvider = $this->createMock(MovieProviderInterface::class);
        $secondProvider->expects($this->once())
            ->method('getType')
            ->willReturn(ProviderTypeEnum::StartsWithWMovie);

        $providers = [$firstProvider, $secondProvider];

        $registry = new MovieProviderRegistry($providers);

        $this->assertSame($firstProvider, $registry->getProvider(ProviderTypeEnum::RandomMovie));
        $this->assertSame($secondProvider, $registry->getProvider(ProviderTypeEnum::StartsWithWMovie));
    }

    public function testGetProviderThrowsExceptionWhenProviderNotFound(): void
    {
        $providers = [];

        $registry = new MovieProviderRegistry($providers);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Provider not found');

        $registry->getProvider(ProviderTypeEnum::RandomMovie);
    }
}
