<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Tests\Unit\Infrastructure\Service;

use Dimkinthepro\Wireguard\Domain\Entity\Peer;
use Dimkinthepro\Wireguard\Infrastructure\DTO\IpAddressDTO;
use Dimkinthepro\Wireguard\Infrastructure\Exception\PeerSetupException;
use Dimkinthepro\Wireguard\Infrastructure\Provider\ConfigProvider;
use Dimkinthepro\Wireguard\Infrastructure\Service\PeerSetupService;
use PHPUnit\Framework\TestCase;

class PeerSetupServiceTest extends TestCase
{
    private const SERVER_IP = '10.0.0.1';
    private const SERVER_MASK = '16';

    /**
     * @dataProvider providerTestSetupIp
     */
    public function testSetupIp(
        Peer $peer,
        string $expectedIp,
        ?string $errorClass = null
    ): void {
        if (null !== $errorClass) {
            self::expectException($errorClass);
        }

        $service = $this->getPeerSetupService();

        $service->setupIp($peer);

        self::assertEquals($expectedIp, $peer->getIpAddress());
    }

    public static function providerTestSetupIp(): array
    {
        return [
            '01' => [
                'peer' => self::getPeer(null),
                'expectedIp' => '',
                'errorClass' => PeerSetupException::class,
            ],
            '02' => [
                'peer' => self::getPeer(0),
                'expectedIp' => '',
                'errorClass' => PeerSetupException::class,
            ],
            '03' => [
                'peer' => self::getPeer(-1),
                'expectedIp' => '',
                'errorClass' => PeerSetupException::class,
            ],
            '04' => [
                'peer' => self::getPeer(1),
                'expectedIp' => '10.0.0.2/16',
            ],
            '05' => [
                'peer' => self::getPeer(255),
                'expectedIp' => '10.0.1.0/16',
            ],
        ];
    }

    private static function getPeer(?int $id): Peer
    {
        $peer = new Peer();
        $peer->setId($id);

        return $peer;
    }

    private function getPeerSetupService(): PeerSetupService
    {
        $serverIp = new IpAddressDTO(self::SERVER_IP, self::SERVER_MASK);
        $configProvider = $this->createMock(ConfigProvider::class);
        $configProvider->method('getServerInternalIp')->willReturn($serverIp);

        return new PeerSetupService($configProvider);
    }
}
