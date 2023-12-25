<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Infrastructure\Service;

use Dimkinthepro\Wireguard\Application\Component\Service\VpnServiceInterface;
use Dimkinthepro\Wireguard\Infrastructure\Provider\ConfigProvider;
use Symfony\Component\Filesystem\Filesystem;

readonly class VpnService implements VpnServiceInterface
{
    public function __construct(
        private Filesystem $filesystem,
        private ConfigProvider $configProvider,
        private StringFormatter $stringFormatter,
    ) {
    }

    public function applyConfig(string $config): void
    {
        $this->filesystem->dumpFile($this->configProvider->getConfigFullPath(), $config);
    }

    public function up(): string
    {
        $result = (string) shell_exec(sprintf('wg-quick up %s 2>&1', $this->configProvider->getWgInterface()));

        return $this->stringFormatter->trim($result);
    }

    public function down(): string
    {
        $result = (string) shell_exec(sprintf('wg-quick down %s 2>&1', $this->configProvider->getWgInterface()));

        return $this->stringFormatter->trim($result);
    }

    public function status(): string
    {
        $result = (string) shell_exec(sprintf('ifconfig %s 2>&1', $this->configProvider->getWgInterface()));

        return $this->stringFormatter->trim($result);
    }
}
