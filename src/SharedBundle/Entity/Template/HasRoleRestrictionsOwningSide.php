<?php
/*
 * This file is part of the Scribe World Application.
 *
 * (c) Scribe Inc. <scribe@scribenet.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Scribe\SharedBundle\Entity\Template;

use Doctrine\Common\Collections\ArrayCollection;
use Scribe\SecurityBundle\Entity\Role;

/**
 * Class HasRoleRestrictionsOwningSide
 *
 * @package Scribe\SharedBundle\Entity\Template
 */
trait HasRoleRestrictionsOwningSide
{
    /**
     * import reading methods for roleRestrictions property
     */
    use HasRoleRestrictionsInverseSide;

    /**
     * Setter for revisions property
     *
     * @param ArrayCollection|null $roleRestrictions collection of roles
     * @return $this
     */
    public function setRoleRestrictions(ArrayCollection $roleRestrictions = null)
    {
        $this->roleRestrictions = $roleRestrictions;

        return $this;
    }

    /**
     * Destroyer for roleRestrictions property
     *
     * @return $this
     */
    public function clearRoleRestrictions()
    {
        $this
            ->getRoleRestrictions()
            ->clear()
        ;

        return $this;
    }

    /**
     * Collections adder for roleRestrictions property
     *
     * @param Role $roleRestriction a role instance to add to the roleRestrictions collection
     * @param bool $unique          requires the passed role instance not already exist within
     *                              the roleRestrictions collection
     * @return $this
     */
    public function addRoleRestrictions(Role $roleRestriction, $unique = true)
    {
        if ($this->hasRoleRestriction($roleRestriction) === false || $unique === false) {
            $this
                ->getRoleRestrictions()
                ->add($roleRestriction)
            ;
        }

        return $this;
    }

    /**
     * Collections remover for roleRestrictions property
     *
     * @param Role $roleRestriction a role instance to remove from collection
     * @return $this
     */
    public function removeRoleRestriction(Role $roleRestriction)
    {
        if ($this->hasRoleRestriction($roleRestriction) === true) {
            $this
                ->getRoleRestrictions()
                ->removeElement($roleRestriction)
            ;
        }

        return $this;
    }
}
