<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Infrastructure\Service;

use chillerlan\QRCode\QRCode;
use Dimkinthepro\Wireguard\Application\Component\Service\QrCodeServiceInterface;

class QrCodeService implements QrCodeServiceInterface
{
    public function getQrCodeImage(string $config): string
    {
        return (new QRCode())->render($config);
    }
}
