<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObjects;


abstract class StringVO
{
    private string $value;

    public function __construct(string $value)
    {
        $this->ensureIsNotNull($value);
        $this->ensureThatStringNotBeMoreLengthThan255Chars($value);
        $this->value = $value;
    }

    private function ensureIsNotNull(string $value): void
    {
        if (!isset($value))
            throw new \InvalidArgumentException('This string is null');
    }

    private function ensureThatStringNotBeMoreLengthThan255Chars(string $value): void
    {
        if (strlen($value) > 255) {
            throw new \InvalidArgumentException('This string is too large');
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
