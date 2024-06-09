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
use App\Movie\Provider\StartsWithWMovieProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

use function mb_strlen;

final class StartsWithWMovieProviderTest extends TestCase
{
    public function testGetMovies(): void
    {
        $provider = $this->getProvider();

        $provider->expects($this->once())
            ->method('getAllMovies')
            ->willReturn([
                'W movie',
                'Not W movie',
                'W and equal characters movie',
            ]);

        $expectedResult = [
            'W and equal characters movie',
        ];

        $result = $provider->getMovies();

        $this->assertEquals($expectedResult, $result);
        foreach ($result as $movie) {
            $this->assertStringStartsWith('W', $movie);
            $this->assertEquals(0, mb_strlen($movie) % 2);
        }
    }

    public function testGetMoviesUtfEncoding(): void
    {
        $provider = $this->getProvider();

        $provider->expects($this->once())
            ->method('getAllMovies')
            ->willReturn([
                'W Movie with Ł',
                'W movie',
                'Not W movie',
            ]);

        $expectedResult = [
            'W Movie with Ł',
        ];

        $result = $provider->getMovies();

        $this->assertEquals($expectedResult, $result);
        foreach ($result as $movie) {
            $this->assertStringStartsWith('W', $movie);
            $this->assertEquals(0, mb_strlen($movie) % 2);
        }
    }

    public function testGetType(): void
    {
        $providerMock = $this->getProvider();

        $this->assertEquals(ProviderTypeEnum::StartsWithWMovie, $providerMock->getType());
    }

    /**
     * @return MockObject&StartsWithWMovieProvider
     */
    private function getProvider(): StartsWithWMovieProvider
    {
        return $this->getMockBuilder(StartsWithWMovieProvider::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getAllMovies'])
            ->getMock();
    }
}
