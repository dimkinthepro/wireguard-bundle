<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Application;

use Dimkinthepro\Wireguard\Application\Component\Exception\WireguardBundleException;
use Dimkinthepro\Wireguard\Application\Component\Service\VpnServiceInterface;

readonly class VpnManager
{
    public function __construct(
        private VpnServiceInterface $vpnService
    ) {
    }

    /**
     * @throws WireguardBundleException
     */
    public function applyConfig(string $config): void
    {
        try {
            $this->vpnService->applyConfig($config);
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
    public function up(): string
    {
        try {
            return $this->vpnService->up();
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
    public function down(): string
    {
        try {
            return $this->vpnService->down();
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
    public function status(): string
    {
        try {
            return $this->vpnService->status();
        } catch (\Throwable $e) {
            throw new WireguardBundleException(
                sprintf('%s (%s) error: "%s"', static::class, __FUNCTION__, $e->getMessage()),
                $e->getCode(),
                $e
            );
        }
    }
}
