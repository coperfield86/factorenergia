<?php

declare(strict_types=1);

namespace Src\Question\Application\Request;

final class SearchQuestionsRequest
{
    private array $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function filters(): array
    {
        return $this->filters;
    }
}
