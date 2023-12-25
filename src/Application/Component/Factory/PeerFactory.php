<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Application\Component\Factory;

use Dimkinthepro\Wireguard\Application\Component\Provider\KeyProviderInterface;
use Dimkinthepro\Wireguard\Domain\Entity\Peer;

class PeerFactory
{
    public function __construct(
        private KeyProviderInterface $keyProvider
    ) {
    }

    public function createPeer(): Peer
    {
        $privateKey = $this->keyProvider->createPrivateKey();
        $publicKey = $this->keyProvider->createPublicKey($privateKey);
        $preSharedKey = $this->keyProvider->createPreSharedKey();

        return new Peer($publicKey, $privateKey, $preSharedKey);
    }
}
