<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Infrastructure\DTO;

use Dimkinthepro\Wireguard\Infrastructure\Provider\ConfigProvider;

readonly class IpAddressDTO
{
    public function __construct(
        public string $address,
        public string $mask,
    ) {
    }

    public function __toString(): string
    {
        return sprintf(
            '%s%s%s',
            $this->address,
            ConfigProvider::IP_MASK_SEPARATOR,
            $this->mask
        );
    }
}
