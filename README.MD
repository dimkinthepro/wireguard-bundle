# Wireguard bundle for Symfony

### 1. Create wireguard bundle configuration:
```yaml
# config/packages/dimkinthepro_wireguard.yaml

dimkinthepro_wireguard:
    wg_interface: 'wg0'
    server_interface: 'eth0' # External interface of the server
    server_external_ip: '93.88.75.12' # External IP of the server
    server_internal_ip: '10.0.0.1/8' # Will be used for wireguard users
    peer_allowed_ips: '0.0.0.0/0' # Can be separated by comma: '192.168.1.0/24, 192.168.2.0/24'
    dns: '8.8.8.8,8.8.4.4'
    port: '51999'
```

### 2. Installation:
```bash
composer require dimkinthepro/wireguard-bundle
```

### 3. Check bundles config:
```php
# config/bundles.php

return [
#...
    Dimkinthepro\Wireguard\DimkintheproWireguardBundle::class => ['all' => true],
];
```

### 4. Grand access to wireguard config for php
```bash
chown "www-data:www-data" /etc/wireguard

```
### 5. Grand access for php
```bash
echo 'www-data ALL=(ALL) NOPASSWD: ALL' >>  /etc/sudoers
```

### 6. Usage example
```php
# src/Infrastructure/Service/VpnService.php

<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

use Dimkinthepro\Wireguard\Application\PeerManager;
use Dimkinthepro\Wireguard\Application\QrCodeGenerator;
use Dimkinthepro\Wireguard\Application\VpnConfigMaker;
use Dimkinthepro\Wireguard\Application\VpnManager;
use Dimkinthepro\Wireguard\Domain\Entity\Peer;

class VpnService
{
    public function __construct(
        private readonly VpnManager $vpnManager,
        private readonly PeerManager $peerManager,
        private readonly VpnConfigMaker $vpnConfigMaker,
        private readonly QrCodeGenerator $qrCodeGenerator,
    ) {
    }

    public function createPeer(): Peer
    {
        $peer = new Peer();
        $peer->setId(1);
        
        $this->peerManager->setupKeyPairs($peer);
        $this->peerManager->setupIp($peer);

        return $peer;
    }

    public function upServer(Peer $peer): void
    {
        $config = $this->vpnConfigMaker->makeServerConfig($peer);
        $this->vpnManager->applyConfig($config);
        $this->vpnManager->up();
    }

    public function getQrCode(Peer $peer): string
    {
        $peerConfig = $this->vpnConfigMaker->makePeerConfig($peer);

        return $this->qrCodeGenerator->getQrCodeImage($peerConfig);
    }
}
```
