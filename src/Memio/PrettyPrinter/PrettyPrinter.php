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
use Memio\PrettyPrinter\TwigExtension\Line\ContractLineStrategy;
use Memio\PrettyPrinter\TwigExtension\Line\FileLineStrategy;
use Memio\PrettyPrinter\TwigExtension\Line\Line;
use Memio\PrettyPrinter\TwigExtension\Line\MethodPhpdocLineStrategy;
use Memio\PrettyPrinter\TwigExtension\Line\ObjectLineStrategy;
use Memio\PrettyPrinter\TwigExtension\Line\StructurePhpdocLineStrategy;
use Memio\PrettyPrinter\TwigExtension\Type;
use Memio\PrettyPrinter\TwigExtension\Whitespace;
use Twig_Environment;

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
     * @param Twig_Environment $twig
     *
     * @api
     */
    public function __construct(Twig_Environment $twig)
    {
        $line = new Line();
        $line->add(new ContractLineStrategy());
        $line->add(new FileLineStrategy());
        $line->add(new MethodPhpdocLineStrategy());
        $line->add(new ObjectLineStrategy());
        $line->add(new StructurePhpdocLineStrategy());

        $twig->addExtension(new Type());
        $twig->addExtension(new Whitespace($line));

        $this->codeGenerators[] = new EmptyCollectionCodeGenerator();
        $this->codeGenerators[] = new PhpdocCollectionCodeGenerator($twig);
        $this->codeGenerators[] = new ModelCollectionCodeGenerator($twig);
        $this->codeGenerators[] = new PhpdocCodeGenerator($twig);
        $this->codeGenerators[] = new ModelCodeGenerator($twig);
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
