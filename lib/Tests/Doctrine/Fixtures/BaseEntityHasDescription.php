<?php

/*
 * This file is part of the Scribe Mantle Bundle.
 *
 * (c) Scribe Inc. <source@scribe.software>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Tests\Doctrine\Fixtures;

use Scribe\Doctrine\Base\Entity\AbstractEntity;
use Scribe\Doctrine\Base\Model\HasDescription;

/**
 * BaseEntityHasDescription.
 */
class BaseEntityHasDescription extends AbstractEntity
{
    use HasDescription;
}

/* EOF */
