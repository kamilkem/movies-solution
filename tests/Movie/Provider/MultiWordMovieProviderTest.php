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

use App\Movie\Provider\MultiWordMovieProvider;
use App\Movie\Provider\ProviderTypeEnum;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

use function str_word_count;

final class MultiWordMovieProviderTest extends TestCase
{
    public function testGetMovies(): void
    {
        $provider = $this->getProvider();

        $provider->expects($this->once())
            ->method('getAllMovies')
            ->willReturn([
                'Single',
                'Double word',
                'Triple word movie',
            ]);

        $expectedResult = [
            'Double word',
            'Triple word movie',
        ];

        $result = $provider->getMovies();

        $this->assertEquals($expectedResult, $result);
        foreach ($result as $movie) {
            $this->assertGreaterThan(1, str_word_count($movie));
        }
    }

    public function testGetType(): void
    {
        $providerMock = $this->getProvider();

        $this->assertEquals(ProviderTypeEnum::MultiWordMovie, $providerMock->getType());
    }

    /**
     * @return MockObject&MultiWordMovieProvider
     */
    private function getProvider(): MultiWordMovieProvider
    {
        return $this->getMockBuilder(MultiWordMovieProvider::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getAllMovies'])
            ->getMock();
    }
}
