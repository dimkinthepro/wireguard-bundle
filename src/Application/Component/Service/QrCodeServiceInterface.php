<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Application\Component\Service;

interface QrCodeServiceInterface
{
    public function getQrCodeImage(string $config): string;
}
