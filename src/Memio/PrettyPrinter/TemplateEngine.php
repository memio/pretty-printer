<?php

/*
 * This file is part of the memio/pretty-printer package.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\PrettyPrinter;

interface TemplateEngine
{
    /**
     * @param string $template
     * @param array  $parameters
     *
     * @return string
     */
    public function render($template, array $parameters = array());
}
