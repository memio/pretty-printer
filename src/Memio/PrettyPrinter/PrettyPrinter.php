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

use Memio\PrettyPrinter\Exception\InvalidArgumentException;
use Memio\PrettyPrinter\CodeGenerator\EmptyCollectionCodeGenerator;
use Memio\PrettyPrinter\CodeGenerator\ModelCollectionCodeGenerator;
use Memio\PrettyPrinter\CodeGenerator\ModelCodeGenerator;
use Memio\PrettyPrinter\CodeGenerator\PhpdocCollectionCodeGenerator;
use Memio\PrettyPrinter\CodeGenerator\PhpdocCodeGenerator;

/**
 * @api
 */
class PrettyPrinter
{
    /**
     * @var array
     */
    private $codeGenerators = array();

    /**
     * @param TemplateEngine $templateEngine
     *
     * @api
     */
    public function __construct(TemplateEngine $templateEngine)
    {
        $this->codeGenerators[] = new EmptyCollectionCodeGenerator();
        $this->codeGenerators[] = new PhpdocCollectionCodeGenerator($templateEngine);
        $this->codeGenerators[] = new ModelCollectionCodeGenerator($templateEngine);
        $this->codeGenerators[] = new PhpdocCodeGenerator($templateEngine);
        $this->codeGenerators[] = new ModelCodeGenerator($templateEngine);
    }

    /**
     * @param mixed $model
     * @param array $parameters
     *
     * @return string
     *
     * @throws InvalidArgumentException If the given model and parameters aren't supported
     *
     * @api
     */
    public function generateCode($model, array $parameters = array())
    {
        foreach ($this->codeGenerators as $codeGenerator) {
            if ($codeGenerator->supports($model, $parameters)) {
                return $codeGenerator->generateCode($model, $parameters);
            }
        }

        throw new InvalidArgumentException('No PrettyPrinter support the given model and parameters');
    }
}
