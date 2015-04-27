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

use Memio\Model\Phpdoc\ParameterTag;
use PhpSpec\ObjectBehavior;
use Twig_Environment;

class PhpdocCollectionCodeGeneratorSpec extends ObjectBehavior
{
    function let(Twig_Environment $twig)
    {
        $this->beConstructedWith($twig);
    }

    function it_is_a_pretty_printer_strategy()
    {
        $this->shouldImplement('Memio\PrettyPrinter\CodeGenerator\CodeGenerator');
    }

    function it_supports_array_of_phpdocs()
    {
        $parameterTag = new ParameterTag('string', 'filename');
        $parameterTags = array($parameterTag);

        $this->supports($parameterTags, array())->shouldBe(true);
    }

    function it_generates_code_using_collection_templates(Twig_Environment $twig)
    {
        $parameterTag = new ParameterTag('string', 'filename');
        $parameterTags = array($parameterTag);

        $twig->render(
            'collection/phpdoc/parameter_tag_collection.twig',
            array('parameter_tag_collection' => $parameterTags)
        )->shouldBeCalled();

        $this->generateCode($parameterTags);
    }
}
