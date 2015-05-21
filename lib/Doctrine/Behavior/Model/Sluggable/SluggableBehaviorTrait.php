<?php

/*
 * This file is part of the Scribe Mantle Bundle.
 *
 * (c) Scribe Inc. <source@scribe.software>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Doctrine\Behavior\Model\Sluggable;

use Scribe\Doctrine\Exception\SubscriberEventORMException;
use Scribe\Doctrine\Exception\SubscriberORMException;

/**
 * Class SluggableBehaviorTrait.
 */
trait SluggableBehaviorTrait
{
    /**
     * @var string
     */
    protected $slug;

    /**
     * Initialize trait.
     */
    public function initializeSlug()
    {
        $this->slug = null;
    }

    /**
     * Set the slug.
     *
     * @param string $slug
     *
     * @throws SubscriberORMException
     *
     * @return bool
     */
    public function setSlug($slug)
    {
        if (true === $this->isSlugAutoGenerated()) {
            throw new SubscriberORMException(
                'Cannot set slug for entity "%s" as it is configured to be auto-generated.',
                SubscriberORMException::CODE_ORM_SUBSCRIBER_GENERIC,
                null, null, get_class($this)
            );
        }

        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the current slug.
     *
     * @return null|string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set if slug is auto-generated.
     *
     * @param bool $autoGenerated
     *
     * @return $this
     */
    public function setSlugAutoGenerated($autoGenerated = true)
    {
        $this->slugAutoGenerated = (bool) $autoGenerated;

        return $this;
    }

    /**
     * Determines if the slug is auto-generated or manually set.
     *
     * @return bool
     */
    public function isSlugAutoGenerated()
    {
        return (bool) (property_exists($this, 'lockedSlug') ?: false);
    }

    /**
     * Return an array of the field name(s) used to generate the slug.
     *
     * @return array
     */
    abstract public function getAutoSlugFields();

    /**
     * Get the delimiter user when multiple fields are slugged.
     *
     * @return string
     */
    public function getAutoSlugDelimiter()
    {
        return '+';
    }

    /**
     * Returns callable used to sanitize slug.
     *
     * @return callable
     */
    public function getAutoSlugSanitizer()
    {
        return function ($fields, $delimiter) {
            array_walk($fields, function ($f) {
                preg_replace('#[^a-z0-9_-]#', '', trim(strtolower($f)));
            });

            return implode($delimiter, $fields);
        };
    }

    /**
     * Generate the slug.
     *
     * @throws SubscriberEventORMException
     *
     * @returns void
     */
    public function triggerGenerateSlugEvent()
    {
        if (false !== $this->isSlugAutoGenerated() || null === $this->slug) {
            $slugFields = $this->getAutoSlugFields();
            $slugUsableFields = [];
            $slugDelimiter = $this->getAutoSlugDelimiter();

            foreach ($slugFields as $f) {
                if (false === property_exists($this, $f)) {
                    continue;
                }

                $value = $this->$f;
                if (null === $value || empty($value)) {
                    continue;
                }

                $slugUsableFields[] = $value;
            }

            if (false === (count($slugUsableFields) > 0)) {
                throw new SubscriberEventORMException(
                    'At lease one of the following fields must be non-null and not-empty to generate slug: %s.',
                    SubscriberEventORMException::CODE_ORM_SUBSCRIBER_EVENT,
                    null, null, implode(',', $slugFields)
                );
            }

            $slugSanitizer = $this->getAutoSlugSanitizer();
            $this->slug = $slugSanitizer($slugUsableFields, $slugDelimiter);
        }
    }
}

/* EOF */
