<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Application;

use Dimkinthepro\Wireguard\Application\Component\Exception\WireguardBundleException;
use Dimkinthepro\Wireguard\Application\Component\Service\VpnConfigServiceInterface;
use Dimkinthepro\Wireguard\Domain\Entity\Peer;

readonly class VpnConfigMaker
{
    public function __construct(
        private VpnConfigServiceInterface $vpnConfigService
    ) {
    }

    /**
     * @throws WireguardBundleException
     */
    public function makePeerConfig(Peer $peer): string
    {
        try {
            return $this->vpnConfigService->makePeerConfig($peer);
        } catch (\Throwable $e) {
            throw new WireguardBundleException(
                sprintf('%s (%s) error: "%s"', static::class, __FUNCTION__, $e->getMessage()),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * @throws WireguardBundleException
     */
    public function makeServerConfig(Peer ...$peers): string
    {
        try {
            return $this->vpnConfigService->makeServerConfig(...$peers);
        } catch (\Throwable $e) {
            throw new WireguardBundleException(
                sprintf('%s (%s) error: "%s"', static::class, __FUNCTION__, $e->getMessage()),
                $e->getCode(),
                $e
            );
        }
    }
}
