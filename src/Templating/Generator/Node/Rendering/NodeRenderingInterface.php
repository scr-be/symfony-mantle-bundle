<?php

/*
 * This file is part of the Scribe Mantle Bundle.
 *
 * (c) Scribe Inc. <source@scribe.software>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\MantleBundle\Templating\Generator\Node\Rendering;

/**
 * Interface NodeRenderingInterface.
 */
interface NodeRenderingInterface
{
    /**
     * Render a node item
     *
     * @param string $string The content/template to be rendered
     * @param array  $args   Arguments to pass to the renderer
     *
     * @return string
     */
    public function render($string, array $args = []);
}

/* EOF */
