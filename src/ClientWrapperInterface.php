<?php

namespace ObjectivePHP\Package\WebSocketClient;

/**
 * Interface Client
 * @package ObjectivePHP\Package\WebSocket
 */
interface ClientWrapperInterface
{
    /**
     * @param $event
     * @param $data
     * @return mixed
     */
    public function send($event, $data);
}
