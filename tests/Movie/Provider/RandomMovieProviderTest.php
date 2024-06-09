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

namespace App\Tests\Movie\Provider;

use App\Movie\Provider\ProviderTypeEnum;
use App\Movie\Provider\RandomMovieProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

use function srand;

final class RandomMovieProviderTest extends TestCase
{
    public function testGetMovies(): void
    {
        // Define seed for php random functions
        srand(1);

        $provider = $this->getProvider();

        $provider->expects($this->exactly(2))
            ->method('getAllMovies')
            ->willReturn([
                'First random movie',
                'Second random movie',
                'Third random movie',
                'Fourth random movie',
                'Fifth random movie',
                'Sixth random movie',
            ]);

        $firstExpectedResult = [
            'First random movie',
            'Third random movie',
            'Sixth random movie',
        ];

        $secondExpectedResult = [
            'First random movie',
            'Second random movie',
            'Sixth random movie',
        ];

        $firstResult = $provider->getMovies();
        $secondResult = $provider->getMovies();

        $this->assertEquals($firstExpectedResult, $firstResult);
        $this->assertCount(3, $firstResult);
        $this->assertEquals($secondExpectedResult, $secondResult);
        $this->assertCount(3, $secondResult);

        srand();
    }

    public function testGetMoviesWithEmptyDataSource(): void
    {
        // Define seed for php random functions
        srand(1);

        $provider = $this->getProvider();

        $provider->expects($this->once())
            ->method('getAllMovies')
            ->willReturn([]);

        $result = $provider->getMovies();

        $this->assertEmpty($result);

        srand();
    }

    public function testGetType(): void
    {
        $providerMock = $this->getProvider();

        $this->assertEquals(ProviderTypeEnum::RandomMovie, $providerMock->getType());
    }

    /**
     * @return MockObject&RandomMovieProvider
     */
    private function getProvider(): RandomMovieProvider
    {
        return $this->getMockBuilder(RandomMovieProvider::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getAllMovies'])
            ->getMock();
    }
}
