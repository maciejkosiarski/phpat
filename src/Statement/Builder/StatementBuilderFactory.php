<?php

declare(strict_types=1);

namespace PHPat\Statement\Builder;

use PHPat\Test\Rule;
use PHPat\Test\TestParser;

class StatementBuilderFactory
{
    /** @var array<Rule> */
    private array $rules;

    public function __construct(TestParser $testParser)
    {
        $this->rules = $testParser();
    }

    public function create(string $classname): StatementBuilder
    {
        /** @var class-string<StatementBuilder> $statementBuilder */
        $statementBuilder = sprintf(
            '%s\\%sStatementBuilder',
            __NAMESPACE__,
            substr($classname, strrpos($classname, '\\') + 1)
        );

        return new $statementBuilder($this->rules);
    }
}
