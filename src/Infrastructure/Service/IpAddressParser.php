<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Infrastructure\Service;

use Dimkinthepro\Wireguard\Infrastructure\DTO\IpAddressDTO;
use Dimkinthepro\Wireguard\Infrastructure\Exception\IpAddressParsingException;

readonly class IpAddressParser
{
    private const IP_ADDRESS_WITH_MASK = '/(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})\/(\d{1,3})/';

    /**
     * @throws IpAddressParsingException
     */
    public function parse(string $address): IpAddressDTO
    {
        $result = @preg_match(self::IP_ADDRESS_WITH_MASK, $address, $matches);
        if (0 === $result || \PREG_NO_ERROR !== preg_last_error()) {
            throw new IpAddressParsingException(sprintf(
                'Invalid ip address provided: "%s"',
                $address
            ));
        }

        return new IpAddressDTO($matches[1], $matches[2]);
    }
}
