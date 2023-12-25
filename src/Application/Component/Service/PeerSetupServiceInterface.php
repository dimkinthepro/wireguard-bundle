<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Application\Component\Service;

use Dimkinthepro\Wireguard\Domain\Entity\Peer;

interface PeerSetupServiceInterface
{
    public function setupIp(Peer $peer): void;
}
