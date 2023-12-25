# Wireguard bundle for Symfony

### 1. Installation:
```bash
composer require dimkinthepro/wireguard-bundle
```

### 2. Check bundles config:
```php
# config/bundles.php

return [
#...
    Dimkinthepro\Wireguard\DimkintheproWireguardBundle::class => ['all' => true],
];
```

### 3. Create bundle configuration:
```yaml
# config/packages/dimkinthepro_wireguard.yaml

dimkinthepro_wireguard:
    wg_interface: 'wg0'
    server_interface: 'eth0'
    server_external_ip: '93.88.75.12'
    server_internal_ip: '10.0.0.1/8'
    peer_allowed_ips: '0.0.0.0/0' # Can be separated by comma: '192.168.1.0/24, 192.168.2.0/24'
    dns: '8.8.8.8, 8.8.4.4'
    port: '51999'
```

### 4. Grand access to wireguard config for php
```bash
chown "www-data:www-data" /etc/wireguard

```
### 5. Grand access for php
```bash
echo 'www-data ALL=(ALL) NOPASSWD: ALL' >>  /etc/sudoers
```
