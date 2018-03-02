<?php

/*
 * This file is part of the memio/pretty-printer package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\PrettyPrinter\CodeGenerator;

use Memio\Model\FullyQualifiedName;
use Memio\PrettyPrinter\TemplateEngine;

class ModelCollectionCodeGenerator implements CodeGenerator
{
    private $templateEngine;

    public function __construct(TemplateEngine $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    public function supports($model): bool
    {
        if (!is_array($model)) {
            return false;
        }
        $firstElement = current($model);
        if (!is_object($firstElement)) {
            return false;
        }
        $fqcn = get_class($firstElement);

        return 1 === preg_match('/^Memio\\\\Model\\\\/', $fqcn);
    }

    public function generateCode($model, array $parameters = []): string
    {
        $firstElement = current($model);
        $fqcn = get_class($firstElement);
        $name = (new FullyQualifiedName($fqcn))->getName();
        $modelName = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $name)).'_collection';
        $parameters[$modelName] = $model;

        return $this->templateEngine->render('collection/'.$modelName, $parameters);
    }
}
