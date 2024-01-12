<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Infrastructure\Service;

use Dimkinthepro\Wireguard\Application\Component\Service\VpnConfigServiceInterface;
use Dimkinthepro\Wireguard\Domain\Entity\Peer;
use Dimkinthepro\Wireguard\Infrastructure\Provider\ConfigProvider;
use Twig\Environment;

readonly class VpnConfigService implements VpnConfigServiceInterface
{
    public function __construct(
        private Environment $twig,
        private ConfigProvider $configProvider
    ) {
    }

    public function makePeerConfig(Peer $peer): string
    {
        return $this->twig->render('@DimkintheproWireguard/peer-config.cfg.twig', [
            'peer' => $peer,
            'serverPort' => $this->configProvider->getPort(),
            'serverDns' => $this->configProvider->getDns(),
            'peerAllowedIps' => $this->configProvider->getPeerAllowedIps(),
            'serverExternalIp' => $this->configProvider->getServerExternalIp(),
        ]);
    }

    public function makeServerConfig(Peer ...$peers): string
    {
        return $this->twig->render('@DimkintheproWireguard/server-config.cfg.twig', [
            'wgInterface' => $this->configProvider->getWgInterface(),
            'serverInterface' => $this->configProvider->getServerInterface(),
            'serverInternalIp' => (string) $this->configProvider->getServerInternalIp(),
            'serverPort' => $this->configProvider->getPort(),
            'peers' => $peers,
        ]);
    }
}
