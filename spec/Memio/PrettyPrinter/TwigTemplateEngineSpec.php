<?php

namespace spec\Memio\PrettyPrinter;

use PhpSpec\ObjectBehavior;
use Twig_Environment;

class TwigTemplateEngineSpec extends ObjectBehavior
{
    const TEMPLATE = 'argument';
    const OUTPUT = '$dateTime';

    function let(Twig_Environment $twig)
    {
        $this->beConstructedWith($twig);
    }

    function it_is_a_template_engine()
    {
        $this->shouldHaveType('Memio\PrettyPrinter\TemplateEngine');
    }

    function it_renders_templates_using_twig(Twig_Environment $twig)
    {
        $parameters = array('name' => 'dateTime');

        $twig->render(self::TEMPLATE.'.twig', $parameters)->willReturn(self::OUTPUT);

        $this->render(self::TEMPLATE, $parameters)->shouldBe(self::OUTPUT);
    }
}
