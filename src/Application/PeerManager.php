<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Application;

use Dimkinthepro\Wireguard\Application\Component\Exception\WireguardBundleException;
use Dimkinthepro\Wireguard\Application\Component\Factory\PeerFactory;
use Dimkinthepro\Wireguard\Application\Component\Service\PeerSetupServiceInterface;
use Dimkinthepro\Wireguard\Domain\Entity\Peer;

readonly class PeerManager
{
    public function __construct(
        private PeerFactory $peerFactory,
        private PeerSetupServiceInterface $peerSetupService,
    ) {
    }

    /**
     * @throws WireguardBundleException
     */
    public function create(): Peer
    {
        try {
            return $this->peerFactory->createPeer();
        } catch (\Throwable $e) {
            throw new WireguardBundleException(
                sprintf('%s (%s) error: "%s"', static::class, __FUNCTION__, $e->getMessage()),
                $e->getCode(),
                $e
            );
        }
    }

    public function setup(Peer $peer): void
    {
        try {
            $this->peerSetupService->setupIp($peer);
        } catch (\Throwable $e) {
            throw new WireguardBundleException(
                sprintf('%s (%s) error: "%s"', static::class, __FUNCTION__, $e->getMessage()),
                $e->getCode(),
                $e
            );
        }
    }
}
