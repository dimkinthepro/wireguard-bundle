<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Application\Component\Provider;

interface KeyProviderInterface
{
    public function createPrivateKey(): string;
    public function createPublicKey(string $privateKey): string;
    public function createPreSharedKey(): string;
}
