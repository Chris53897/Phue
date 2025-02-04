<?php
/**
 * Phue: Philips Hue PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2012 Michael K. Squires
 * @license   http://github.com/sqmk/Phue/wiki/License
 */
namespace Phue\Command;

use Phue\Client;
use Phue\Transport\TransportInterface;

/**
 * Start Light Scan command
 */
class StartLightScan implements CommandInterface
{
    /**
     * @param string[]|null $deviceIds Array of device ids
     */
    public function __construct(protected ?array $deviceIds = null)
    {}

    public function send(Client $client): mixed
    {
        $body = null;

        if ($this->deviceIds !== null) {
            $body = new \stdClass();
            $body->deviceid = $this->deviceIds;
        }

        // Get response
        $response = $client->getTransport()->sendRequest(
            "/api/{$client->getUsername()}/lights",
            TransportInterface::METHOD_POST,
            $body
        );

        return $response;
    }
}
