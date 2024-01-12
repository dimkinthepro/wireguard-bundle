<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Tests\Unit\Infrastructure\Service;

use Dimkinthepro\Wireguard\Infrastructure\DTO\IpAddressDTO;
use Dimkinthepro\Wireguard\Infrastructure\Exception\IpAddressParsingException;
use Dimkinthepro\Wireguard\Infrastructure\Service\IpAddressParser;
use PHPUnit\Framework\TestCase;

class IpAddressParserTest extends TestCase
{
    /**
     * @dataProvider providerTestParse
     */
    public function testParse(
        string $address,
        ?IpAddressDTO $expectedResult,
        ?string $errorClass = null
    ): void {
        if (null !== $errorClass) {
            self::expectException($errorClass);
        }

        $parser = new IpAddressParser();
        $result = $parser->parse($address);

        self::assertEquals($expectedResult, $result);
    }

    public static function providerTestParse(): array
    {
        return [
            '01' => [
                'address' => '',
                'expectedResult' => null,
                'errorClass' => IpAddressParsingException::class,
            ],
            '02' => [
                'address' => '255.255.255.255',
                'expectedResult' => null,
                'errorClass' => IpAddressParsingException::class,
            ],
            '03' => [
                'address' => '255.255.255.255.232',
                'expectedResult' => null,
                'errorClass' => IpAddressParsingException::class,
            ],
            '04' => [
                'address' => '10.0.0.1/255',
                'expectedResult' => new IpAddressDTO('10.0.0.1', '255'),
            ],
            '05' => [
                'address' => '192.168.0.1/24',
                'expectedResult' => new IpAddressDTO('192.168.0.1', '24'),
            ],
        ];
    }
}
