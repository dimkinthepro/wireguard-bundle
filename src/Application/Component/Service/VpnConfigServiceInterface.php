<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Application\Component\Service;

use Dimkinthepro\Wireguard\Domain\Entity\Peer;

interface VpnConfigServiceInterface
{
    public function makePeerConfig(Peer $peer): string;
    public function makeServerConfig(Peer ...$peers): string;
}
