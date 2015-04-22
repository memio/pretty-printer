<?php

/*
 * This file is part of the memio/pretty-printer package.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\PrettyPrinter\PrettyPrinter;

use Memio\Model\FullyQualifiedName;
use Twig_Environment;

class PhpdocPrettyPrinter implements PrettyPrinterStrategy
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @param Twig_Environment $twig_Environment
     */
    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * {@inheritDoc}
     */
    public function supports($model)
    {
        if (!is_object($model)) {
            return false;
        }
        $fqcn = get_class($model);

        return 1 === preg_match('/^Memio\\\\Model\\\\Phpdoc\\\\/', $fqcn);
    }

    /**
     * {@inheritDoc}
     */
    public function generateCode($model, array $parameters = array())
    {
        $fqcn = get_class($model);
        $name = FullyQualifiedName::make($fqcn)->getName();
        $modelName = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $name));
        $parameters[$modelName] = $model;

        return $this->twig->render('phpdoc/'.$modelName.'.twig', $parameters);
    }
}
