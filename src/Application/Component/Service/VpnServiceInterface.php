<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Application\Component\Service;

interface VpnServiceInterface
{
    public function applyConfig(string $config): void;
    public function up(): string;
    public function down(): string;
    public function status(): string;
}
