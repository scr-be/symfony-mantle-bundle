<?php

/*
 * This file is part of the Scribe Mantle Bundle.
 *
 * (c) Scribe Inc. <source@scribe.software>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\MantleBundle\Doctrine\Entity\Node;

use Doctrine\Common\Collections\ArrayCollection;
use Scribe\Doctrine\Base\Entity\AbstractEntity;
use Scribe\Doctrine\Behavior\Model\Sluggable\SluggableBehaviorTrait;
use Scribe\Exception\ExceptionInterface;
use Scribe\Doctrine\Exception\SubscriberEventORMException;

/**
 * NodeRenderEngine.
 */
class NodeRenderEngine extends AbstractEntity
{
    use SluggableBehaviorTrait;

    /**
     * @var ArrayCollection
     */
    private $revisions;

    /**
     * perform any entity setup.
     */
    public function __construct()
    {
        parent::__construct();

        $this->revisions = new ArrayCollection();
    }

    /**
     * Support for casting from object to string.
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__.':'.$this->getSlug();
    }

    /**
     * This entity must not have auto-generated slugs.
     *
     * @throws SubscriberEventORMException
     */
    public function getAutoSlugFields()
    {
        throw new SubscriberEventORMException(
            'This entity does not support automatically generating slugs!',
            ExceptionInterface::CODE_GENERIC_FROM_MANTLE_BDL
        );
    }

    /**
     * Disable auto-generated slugs.
     *
     * @return bool
     */
    public function isSlugAutoGenerated()
    {
        return false;
    }

    /**
     * Gets the value of revisions.
     *
     * @return NodeRevision[]
     */
    public function getRevisions()
    {
        return $this->revisions;
    }

    /**
     * Sets the value of revisions.
     *
     * @param ArrayCollection $revisions
     *
     * @return $this
     */
    public function setRevisions(ArrayCollection $revisions)
    {
        $this->revisions = $revisions;

        return $this;
    }
}
