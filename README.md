# Memio's PrettyPrinter [![SensioLabsInsight](https://insight.sensiolabs.com/projects/c8194cd1-0f80-4bce-9ab2-8368db5411b3/mini.png)](https://insight.sensiolabs.com/projects/c8194cd1-0f80-4bce-9ab2-8368db5411b3) [![Travis CI](https://travis-ci.org/memio/pretty-printer.png)](https://travis-ci.org/memio/pretty-printer)

`PrettyPrinter` is a code generator (printer) that takes a Model and calls the
appropriate `TemplateEngine` to actually generate the corresponding code,
using highly opinionated coding standards (pretty).

`PrettyPrinter` returns a string that can be saved in a file, dislpayed on a
console output or displayed in a web page. Possibilities are endless!

> **Note**: This package is part of [Memio](http://memio.github.io/memio).
> Have a look at [the main repository](http://github.com/memio/memio).

## Installation

Install it using [Composer](https://getcomposer.org/download):

    composer require memio/pretty-printer:~1.0@rc

## Example

We're going to generate a class with a constructor and two attributes:

```php
<?php

require __DIR__.'/vendor/autoload.php';

use Memio\PrettyPrinter\PrettyPrinter;
use Memio\PrettyPrinter\TwigExtension\Line\ContractLineStrategy;
use Memio\PrettyPrinter\TwigExtension\Line\FileLineStrategy;
use Memio\PrettyPrinter\TwigExtension\Line\Line;
use Memio\PrettyPrinter\TwigExtension\Line\MethodPhpdocLineStrategy;
use Memio\PrettyPrinter\TwigExtension\Line\ObjectLineStrategy;
use Memio\PrettyPrinter\TwigExtension\Line\StructurePhpdocLineStrategy;
use Memio\PrettyPrinter\TwigExtension\Type;
use Memio\PrettyPrinter\TwigExtension\Whitespace;
use Memio\PrettyPrinter\TwigTemplateEngine;
use Memio\Model\File;
use Memio\Model\Object;
use Memio\Model\Property;
use Memio\Model\Method;
use Memio\Model\Argument;

// Initialize the code generator
$loader = new \Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new \Twig_Environment($loader);

$line = new Line();
$line->add(new ContractLineStrategy());
$line->add(new FileLineStrategy());
$line->add(new MethodPhpdocLineStrategy());
$line->add(new ObjectLineStrategy());
$line->add(new StructurePhpdocLineStrategy());

$twig->addExtension(new Type());
$twig->addExtension(new Whitespace($line));

$templateEngine = new TwigTemplateEngine($twig);
$prettyPrinter = new PrettyPrinter($templateEngine);

// Describe the code you want to generate using "Models"
$myService = File::make('src/Vendor/Project/MyService.php')
    ->setStructure(
        Object::make('Vendor\Project\MyService')
            ->addProperty(new Property('createdAt'))
            ->addProperty(new Property('filename'))
            ->addMethod(
                Method::make('__construct')
                    ->addArgument(new Argument('DateTime', 'createdAt'))
                    ->addArgument(new Argument('string', 'filename'))
            )
    )
;

// Generate the code and display in the console
echo $prettyPrinter->generateCode($myService);

// Or display it in a browser
// echo '<pre>'.htmlspecialchars($prettyPrinter->generateCode($myService)).'</pre>';
```

With this simple example, we get the following output:

```
<?php

namespace Vendor\Project;

class MyService
{
    private $createdAt;

    private $filename;

    public function __construct(DateTime $createdAt, $filename)
    {
    }
}
```

Have a look at [the main respository](http://github.com/memio/memio) to discover the full power of Memio.

## Want to know more?

Memio uses [phpspec](http://phpspec.net/), which means the tests also provide the documentation.
Not convinced? Then clone this repository and run the following commands:

    composer install
    ./vendor/bin/phpspec run -n -f pretty

You can see the current and past versions using one of the following:

* the `git tag` command
* the [releases page on Github](https://github.com/memio/memio/releases)
* the file listing the [changes between versions](CHANGELOG.md)

And finally some meta documentation:

* [copyright and MIT license](LICENSE)
* [versioning and branching models](VERSIONING.md)
* [contribution instructions](CONTRIBUTING.md)
