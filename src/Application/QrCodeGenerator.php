<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Application;

use Dimkinthepro\Wireguard\Application\Component\Exception\WireguardBundleException;
use Dimkinthepro\Wireguard\Application\Component\Service\QrCodeServiceInterface;

readonly class QrCodeGenerator
{
    public function __construct(
        private QrCodeServiceInterface $qrCodeService
    ) {
    }

    /**
     * @throws WireguardBundleException
     */
    public function getQrCodeImage(string $config): string
    {
        try {
            return $this->qrCodeService->getQrCodeImage($config);
        } catch (\Throwable $e) {
            throw new WireguardBundleException(
                sprintf('%s (%s) error: "%s"', static::class, __FUNCTION__, $e->getMessage()),
                $e->getCode(),
                $e
            );
        }
    }
}
