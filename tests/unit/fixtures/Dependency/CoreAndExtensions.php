<?php

declare(strict_types=1);

namespace Tests\PHPat\unit\fixtures\Dependency;

use BadMethodCallException;
use Exception;

class CoreAndExtensions
{
    /**
     * @throws Exception
     */
    public function doSomething(): void
    {
        throw new BadMethodCallException();
    }
}