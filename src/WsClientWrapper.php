<?php

namespace ObjectivePHP\Package\WebSocketClient;

use Hoa\Websocket\Client as HoaClient;

/**
 * Class WsClientWrapper
 * @package ObjectivePHP\Package\WebSocketClient
 */
class WsClientWrapper implements ClientWrapperInterface
{
    /**
     * @var HoaClient
     */
    protected $client;

    /**
     * Server constructor.
     * @param HoaClient $client
     */
    public function __construct(HoaClient $client = null)
    {
        $this->setClient($client);
    }

    /**
     * @return HoaClient
     */
    public function getClient() : HoaClient
    {
        return $this->client;
    }

    /**
     * @param HoaClient $client
     * @return $this
     */
    public function setClient(HoaClient $client)
    {
        $this->client = $client;

        return $this;
    }

    public function send($event, $data)
    {
        $json = json_encode(['event' => $event, 'data' => $data]);

        $client = $this->getClient();
        $client->connect();
        $client->send($json);

        /** TODO : receive ? **/
        //$client->receive();
        $client->close();
    }
}
