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

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class MovieControllerTest extends WebTestCase
{
    public function testRandomMovies(): void
    {
        $client = self::createClient();
        $client->request('GET', '/movies/random');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        /** @var string[] $response */
        $response = json_decode((string)$client->getResponse()->getContent(), true);
        $this->assertCount(3, $response);
    }

    public function testMultiWordMovies(): void
    {
        $client = self::createClient();
        $client->request('GET', '/movies/multi-word');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        /** @var string[] $response */
        $response = json_decode((string)$client->getResponse()->getContent(), true);
        foreach ($response as $movie) {
            $this->assertGreaterThan(1, str_word_count($movie));
        }
    }

    public function testStartsWithWMovies(): void
    {
        $client = self::createClient();
        $client->request('GET', '/movies/starts-with-w');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        /** @var string[] $response */
        $response = (array)json_decode((string)$client->getResponse()->getContent(), true);
        foreach ($response as $movie) {
            $this->assertStringStartsWith('W', $movie);
            $this->assertEquals(0, mb_strlen($movie) % 2);
        }
    }
}
