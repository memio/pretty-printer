<?php

/*
 * This file is part of the memio/pretty-printer package.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Memio\PrettyPrinter\CodeGenerator;

use Memio\Model\Argument;
use PhpSpec\ObjectBehavior;
use Twig_Environment;

class ModelCodeGeneratorSpec extends ObjectBehavior
{
    function let(Twig_Environment $twig)
    {
        $this->beConstructedWith($twig);
    }

    function it_is_a_pretty_printer_strategy()
    {
        $this->shouldImplement('Memio\PrettyPrinter\CodeGenerator\CodeGenerator');
    }

    function it_supports_models()
    {
        $argument = new Argument('bool', 'isObject');

        $this->supports($argument, array())->shouldBe(true);
    }

    function it_generates_code_using_root_templates(Twig_Environment $twig)
    {
        $argument = new Argument('string', 'filename');

        $twig->render('argument.twig', array('argument' => $argument))->shouldBeCalled();

        $this->generateCode($argument);
    }
}
