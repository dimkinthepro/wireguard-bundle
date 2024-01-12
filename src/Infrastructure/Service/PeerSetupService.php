<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Infrastructure\Service;

use Dimkinthepro\Wireguard\Application\Component\Service\PeerSetupServiceInterface;
use Dimkinthepro\Wireguard\Domain\Entity\Peer;
use Dimkinthepro\Wireguard\Infrastructure\Exception\PeerSetupException;
use Dimkinthepro\Wireguard\Infrastructure\Provider\ConfigProvider;

class PeerSetupService implements PeerSetupServiceInterface
{
    public function __construct(
        private ConfigProvider $configProvider
    ) {
    }

    /**
     * @throws PeerSetupException
     */
    public function setupIp(Peer $peer): void
    {
        if (null === $peer->getId() || 0 >= $peer->getId()) {
            throw new PeerSetupException(sprintf(
                'Peer id is empty value: "%s"',
                $peer->getId()
            ));
        }

        $serverIp = ip2long($this->configProvider->getServerInternalIp()->address);
        $peerIp = $serverIp + $peer->getId();
        $peer->setIpAddress(sprintf(
            '%s%s%s',
            long2ip($peerIp),
            ConfigProvider::IP_MASK_SEPARATOR,
            $this->configProvider->getServerInternalIp()->mask
        ));
    }
}
