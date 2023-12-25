<?php

declare(strict_types=1);

namespace Dimkinthepro\Wireguard\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public const ROOT_NODE = 'dimkinthepro_wireguard';
    public const WG_INTERFACE_KEY = 'wg_interface';
    public const WG_INTERFACE_VALUE = 'wg0';
    public const SERVER_INTERFACE_KEY = 'server_interface';
    public const SERVER_INTERFACE_VALUE = 'eth0';
    public const SERVER_EXTERNAL_IP_KEY = 'server_external_ip';
    public const SERVER_EXTERNAL_IP_VALUE = '93.88.75.12';
    public const SERVER_INTERNAL_IP_KEY = 'server_internal_ip';
    public const SERVER_INTERNAL_IP_VALUE = '10.0.0.1/8';
    public const PEER_ALLOWED_IPS_KEY = 'peer_allowed_ips';
    public const PEER_ALLOWED_IPS_VALUE = '0.0.0.0/0';
    public const DNS_KEY = 'dns';
    public const DNS_VALUE = '8.8.8.8';
    public const PORT_KEY = 'port';
    public const PORT_VALUE = '51999';

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(self::ROOT_NODE);

        $treeBuilder
            ->getRootNode()
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode(self::WG_INTERFACE_KEY)
                    ->defaultValue(self::WG_INTERFACE_VALUE)
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode(self::SERVER_INTERFACE_KEY)
                    ->defaultValue(self::SERVER_INTERFACE_VALUE)
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode(self::SERVER_EXTERNAL_IP_KEY)
                    ->defaultValue(self::SERVER_EXTERNAL_IP_VALUE)
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode(self::SERVER_INTERNAL_IP_KEY)
                    ->defaultValue(self::SERVER_INTERNAL_IP_VALUE)
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode(self::PEER_ALLOWED_IPS_KEY)
                    ->defaultValue(self::PEER_ALLOWED_IPS_VALUE)
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode(self::DNS_KEY)
                    ->defaultValue(self::DNS_VALUE)
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode(self::PORT_KEY)
                    ->defaultValue(self::PORT_VALUE)
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
