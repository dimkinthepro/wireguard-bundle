<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Tests\Unit\Infrastructure\Service;

use Dimkinthepro\Wireguard\Infrastructure\Service\QrCodeService;
use PHPUnit\Framework\TestCase;

class QrCodeServiceTest extends TestCase
{
    public function testGetQrCodeImage(): void
    {
        $config = '[Interface]
PrivateKey = 2BlSbG6p9LhdUOSM/7hX0ziJbt/N2QY8YiDuvCYtflY=
ListenPort = 443
Address = 10.10.10.4/32
DNS = 8.8.8.8, 8.8.4.4

[Peer]
PublicKey = nZG9KcgUuk1roi12AP5rL3r27sU6ZjCGiFjCGrJpnImI=
PresharedKey = rL25SS644YnV/rd/KmOa0b09hPI8dlwnZM/SBrFS5gOE=
AllowedIPs = 0.0.0.0/0
Endpoint = 93.88.75.11:443';

        $service = new QrCodeService();
        $code = $service->getQrCodeImage($config);

        self::assertIsString($code);
    }
}
