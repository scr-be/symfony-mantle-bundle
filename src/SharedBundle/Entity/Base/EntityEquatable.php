<?php
/*
 * This file is part of the Scribe World Application.
 *
 * (c) Scribe Inc. <scribe@scribenet.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Scribe\SharedBundle\Entity\Base;

use Scribe\SharedBundle\Entity\Base\Entity;
use Scribe\SharedBundle\Entity\Interfaces\EntityEquatableInterface;

/**
 * Interface EntityEquatableInterface
 * Used to test if two objects are equal in orm and entity contexts.
 *
 * @package Scribe\SharedBundle\Entity\Base
 */
trait EntityEquatable
{
    /**
     * Simple check to see if the passed Entity is of the same type as the
     * current object using {@see get_class()} or a similar method.
     *
     * @todo   Implement this function
     * @param  Entity $entity the entity object to check against
     * @return bool
     */
    public function isEqualTo(Entity $entity) {

        return true;
    }

    /**
     * Check to see if the passed Entity object has the same orm-specified
     * {@see $this->id} value as the current object. This should not allow a
     * comparison of two null id values to return true.
     *
     * @todo   Implement this function
     * @param  Entity $entity the entity object to check against
     * @return bool
     */
    public function isEqualToId(Entity $entity) {

        return true;
    }

    /**
     * Check to see if the passed Entity object has the same property values
     * as the current object. This includes id, as well as all other class
     * properties.
     *
     * @todo   Implement this function
     * @param  Entity $entity the entity object to check against
     * @return bool
     */
    public function isEqualToProperties(Entity $entity) {

        return true;
    }
}
