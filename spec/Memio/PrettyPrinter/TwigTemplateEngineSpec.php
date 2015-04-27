<?php

namespace spec\Memio\PrettyPrinter;

use PhpSpec\ObjectBehavior;
use Twig_Environment;
use Twig_Loader_Filesystem;

class TwigTemplateEngineSpec extends ObjectBehavior
{
    const TEMPLATE_PATH = '/tmp/templates';
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

    function it_canhave_more_paths(Twig_Environment $twig, Twig_Loader_Filesystem $loader)
    {
        $twig->getLoader()->willReturn($loader);
        $loader->addPath(self::TEMPLATE_PATH)->shouldBeCalled();

        $this->addPath(self::TEMPLATE_PATH);
    }

    function it_renders_templates_using_twig(Twig_Environment $twig)
    {
        $parameters = array('name' => 'dateTime');

        $twig->render(self::TEMPLATE.'.twig', $parameters)->willReturn(self::OUTPUT);

        $this->render(self::TEMPLATE, $parameters)->shouldBe(self::OUTPUT);
    }
}
