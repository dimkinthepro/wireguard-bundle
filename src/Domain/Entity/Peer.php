<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\Domain\Entity;

class Peer
{
    private ?int $id = null;
    private string $publicKey;
    private string $privateKey;
    private string $preSharedKey;
    private string $ipAddress;
    private ?int $port;

    public function __construct(
        string $publicKey,
        string $privateKey,
        string $preSharedKey,
        ?int $port = null,
    ) {
        $this->publicKey = $publicKey;
        $this->privateKey = $privateKey;
        $this->preSharedKey = $preSharedKey;
        $this->port = $port;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function setPublicKey(string $publicKey): void
    {
        $this->publicKey = $publicKey;
    }

    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    public function setPrivateKey(string $privateKey): void
    {
        $this->privateKey = $privateKey;
    }

    public function getPreSharedKey(): string
    {
        return $this->preSharedKey;
    }

    public function setPreSharedKey(string $preSharedKey): void
    {
        $this->preSharedKey = $preSharedKey;
    }

    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    public function setIpAddress(string $ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }

    public function getPort(): ?int
    {
        return $this->port;
    }

    public function setPort(?int $port): void
    {
        $this->port = $port;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'publicKey' => $this->getPublicKey(),
            'privateKey' => $this->getPrivateKey(),
            'preSharedKey' => $this->getPreSharedKey(),
            'ipAddress' => $this->getIpAddress(),
            'port' => $this->getPort(),
        ];
    }
}
