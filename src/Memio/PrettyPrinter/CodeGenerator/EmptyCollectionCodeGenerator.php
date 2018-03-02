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

class EmptyCollectionCodeGenerator implements CodeGenerator
{
    public function supports($model): bool
    {
        return is_array($model) && empty($model);
    }

    public function generateCode($model, array $parameters = []): string
    {
        return '';
    }
}
