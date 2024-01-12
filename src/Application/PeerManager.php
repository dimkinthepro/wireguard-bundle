<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Application;

use Dimkinthepro\Wireguard\Application\Component\Exception\WireguardBundleException;
use Dimkinthepro\Wireguard\Application\Component\Provider\KeyProviderInterface;
use Dimkinthepro\Wireguard\Application\Component\Service\PeerSetupServiceInterface;
use Dimkinthepro\Wireguard\Domain\Entity\Peer;

readonly class PeerManager
{
    public function __construct(
        private KeyProviderInterface $keyProvider,
        private PeerSetupServiceInterface $peerSetupService,
    ) {
    }

    /**
     * @throws WireguardBundleException
     */
    public function setupKeyPairs(Peer $peer): void
    {
        try {
            $privateKey = $this->keyProvider->createPrivateKey();
            $publicKey = $this->keyProvider->createPublicKey($privateKey);
            $preSharedKey = $this->keyProvider->createPreSharedKey();

            $peer->setPrivateKey($privateKey);
            $peer->setPublicKey($publicKey);
            $peer->setPreSharedKey($preSharedKey);
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
    public function setupIp(Peer $peer): void
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
