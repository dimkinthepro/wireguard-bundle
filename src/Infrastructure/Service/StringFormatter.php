<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Infrastructure\Service;

class StringFormatter
{
    public function trim(string $string): string
    {
        return str_replace("\n", '', trim($string));
    }
}
