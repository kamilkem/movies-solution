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

interface MoviesProviderRegistryInterface
{
    public function getProvider(ProviderTypeEnum $type): MovieProviderInterface;
}
