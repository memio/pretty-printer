# How to contribute

Everybody should be able to help. Here's how you can make this project more
awesome:

1. [Fork it](https://github.com/memio/pretty-printer/fork_select)
2. improve it
3. submit a [pull request](https://help.github.com/articles/creating-a-pull-request)

Your work will then be reviewed as soon as possible (suggestions about some
changes, improvements or alternatives may be given).

Here's some tips to make you the best contributor ever:

* [Standard code](#standard-code)
* [Specifications](#specifications)
* [Keeping your fork up-to-date](#keeping-your-fork-up-to-date)

## Standard code

Use [PHP CS fixer](http://cs.sensiolabs.org/) to make your code compliant with
Memio PrettyPrinter's coding standards:

    ./vendor/bin/php-cs-fixer fix --config=sf23 .

## Specifications

Memio PrettyPrinter drives its development using [phpspec](http://www.phpspec.net/):

    # Generate the specification class:
    phpspec describe 'Memio\Memio\MyNewClass'

    # Customize the specification class:
    $EDITOR tests/spec/Memio/pretty-printer/MyNewClass.php

    # Generate the specified class:
    phpspec run

    # Customize the class:
    $EDITOR src/Memio/pretty-printer/MyNewClass.php

    phpspec run # Should be green!

## Keeping your fork up-to-date

To keep your fork up-to-date, you should track the upstream (original) one
using the following command:

    git remote add upstream https://github.com/memio/pretty-printer.git

Then get the upstream changes:

    git checkout master
    git pull --rebase origin master
    git pull --rebase upstream master
    git checkout <your-branch>
    git rebase master

Finally, publish your changes:

    git push -f origin <your-branch>

Your pull request will be automatically updated.
