<?php

namespace PHPat\Selector;

use PHPStan\Reflection\ClassReflection;

class ClassImplements implements SelectorInterface
{
    private string $classname;

    /**
     * @param class-string $classname
     */
    public function __construct(string $classname)
    {
        $this->classname = $classname;
    }

    public function matches(ClassReflection $classReflection): bool
    {
        return $classReflection->implementsInterface($this->classname);
    }
}
