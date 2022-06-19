<?php

declare(strict_types=1);

namespace Src\Shared\Domain;

use DateTimeInterface;

final class Utils
{
    public static function dateToString(DateTimeInterface $date): string
    {
        $timestamp             = $date->getTimestamp();
        $microseconds          = $date->format('u');
        $millisecondsOnASecond = 1000;

        return (string) (((float) ($timestamp . '.' . $microseconds)) * $millisecondsOnASecond);
    }

    public static function toCamelCase(string $text): string
    {
        return lcfirst(str_replace('_', '', ucwords($text, '_')));
    }

    public static function getSource(): ?string
    {
        $source = explode("/", $_SERVER['REQUEST_URI']);
        if (isset($source[2]) && $source[2] != null) {
            $source = explode("?", $source[2]);
        }
        return (isset($source[0]) && $source[0] != null) ? $source[0] : null;
    }
}
