<?php

namespace ObjectivePHP\Package\WebSocketClient;

use Hoa\Websocket\Client;
use Hoa\Socket\Client as HoaClient;
use ObjectivePHP\Application\ApplicationInterface;
use ObjectivePHP\Application\Middleware\AbstractMiddleware;
use ObjectivePHP\Package\WebSocketClient\Config\WebSocketClientConfig;

/**
 * Class WebSocketClient
 * @package ObjectivePHP\Package\WebSocketClient
 */
class WebSocketClientPackage extends AbstractMiddleware
{
    /**
     * WebSocketClient constructor.
     */
    public function run(ApplicationInterface $app)
    {
        $configs = $app->getConfig()->subset(WebSocketClientConfig::class);

        foreach ($configs as $identifier => $config) {
            $serverBinding = $config->getProtocol() . '://' . $config->getBindingAddress() . ':' . $config->getPort();

            $client = new Client(new HoaClient($serverBinding));

            $wsClient = new WsClientWrapper($client);

            $app->getServicesFactory()->registerService([
                'id' => 'ws-client.' . $identifier,
                'instance' => $wsClient
            ]);
        }
    }
}