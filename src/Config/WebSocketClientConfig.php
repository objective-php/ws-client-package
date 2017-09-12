<?php

namespace ObjectivePHP\Package\WebSocketClient\Config;

use ObjectivePHP\Config\Exception;
use ObjectivePHP\Config\SingleDirective;

/**
 * Class WebSocketClientConfig
 * @package ObjectivePHP\Package\WebSocketClient\Config
 */
class WebSocketClientConfig extends SingleDirective
{
    protected $bindingAddress;

    protected $port;

    protected $protocol;

    protected $listeners = [];

    /**
     * WebSocketClientConfig constructor.
     * @param $identifier
     * @param array $listeners
     * @param int $port
     * @param string $bindingAddress
     * @param string $protocol
     */
    public function __construct($identifier, $listeners = [], $port = 8889, $bindingAddress = '127.0.0.1', $protocol = 'ws')
    {
        $this->setIdentifier(get_class($this) . '.' . $identifier);
        $this->setPort($port);
        $this->setBindingAddress($bindingAddress);
        $this->setProtocol($protocol);
        $this->setListeners($listeners);
    }

    /**
     * @return mixed
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param $protocol
     * @return $this
     * @throws Exception
     */
    public function setProtocol($protocol)
    {
        if(!in_array($protocol, ['tcp', 'ws', 'wss']))
        {
            throw new Exception('Forbidden protocol value. Allowed values are: tcp, ws and wss');
        }
        $this->protocol = $protocol;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBindingAddress()
    {
        return $this->bindingAddress;
    }

    /**
     * @param $bindingAddress
     * @return $this
     */
    public function setBindingAddress($bindingAddress)
    {
        $this->bindingAddress = $bindingAddress;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param $port
     * @return $this
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return array
     */
    public function getListeners(): array
    {
        return $this->listeners;
    }

    /**
     * @param array $listeners
     */
    public function setListeners(array $listeners)
    {
        $this->listeners = $listeners;
    }
}
