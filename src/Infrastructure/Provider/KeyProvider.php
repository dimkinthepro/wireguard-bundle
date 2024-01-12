<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Infrastructure\Provider;

use Dimkinthepro\Wireguard\Application\Component\Provider\KeyProviderInterface;
use Dimkinthepro\Wireguard\Infrastructure\Service\StringFormatter;

readonly class KeyProvider implements KeyProviderInterface
{
    public function __construct(
        private StringFormatter $stringFormatter
    ) {
    }

    public function createPrivateKey(): string
    {
        $key = (string) shell_exec('wg genkey');

        return $this->stringFormatter->trim($key);
    }

    public function createPublicKey(string $privateKey): string
    {
        $key = (string) shell_exec(sprintf('echo "%s" | wg pubkey', $privateKey));

        return $this->stringFormatter->trim($key);
    }

    public function createPreSharedKey(): string
    {
        $key = (string) shell_exec('wg genpsk');

        return $this->stringFormatter->trim($key);
    }
}
