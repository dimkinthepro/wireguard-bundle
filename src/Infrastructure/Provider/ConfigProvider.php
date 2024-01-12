<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Infrastructure\Provider;

use Dimkinthepro\Wireguard\Infrastructure\DTO\IpAddressDTO;
use Dimkinthepro\Wireguard\Infrastructure\Service\IpAddressParser;

class ConfigProvider
{
    public const WIREGUARD_PATH = '/etc/wireguard';
    public const CONFIG_SUFFIX = '.conf';
    public const IP_MASK_SEPARATOR = '/';
    public const USER_MASK_VALUE = '32';
    public const IP_ADDRESS_ANY = '0.0.0.0';
    public const MASK_ANY = '0';

    public function __construct(
        private string $wgInterface,
        private string $serverInterface,
        private string $serverExternalIp,
        private string $serverInternalIp,
        private string $peerAllowedIps,
        private string $dns,
        private string $port,
        private IpAddressParser $ipAddressParser,
    ) {
    }

    public function getWireguardPath(): string
    {
        return self::WIREGUARD_PATH;
    }

    public function getWgInterface(): string
    {
        return $this->wgInterface;
    }

    public function getServerInterface(): string
    {
        return $this->serverInterface;
    }

    public function getServerExternalIp(): string
    {
        return $this->serverExternalIp;
    }

    public function getServerInternalIp(): IpAddressDTO
    {
        return $this->ipAddressParser->parse($this->serverInternalIp);
    }

    /**
     * @return IpAddressDTO[]
     */
    public function getPeerAllowedIps(): array
    {
        return array_map(function (string $ipAddress) {
            return $this->ipAddressParser->parse(trim($ipAddress));
        }, explode(',', $this->peerAllowedIps));
    }

    public function getDns(): string
    {
        return $this->dns;
    }

    public function getPort(): string
    {
        return $this->port;
    }

    public function getConfigFullPath(): string
    {
        return sprintf(
            '%s%s%s%s',
            $this->getWireguardPath(),
            \DIRECTORY_SEPARATOR,
            $this->getWgInterface(),
            self::CONFIG_SUFFIX
        );
    }
}
