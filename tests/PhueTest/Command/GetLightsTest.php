<?php
/**
 * Phue: Philips Hue PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2012 Michael K. Squires
 * @license   http://github.com/sqmk/Phue/wiki/License
 * @package   Phue
 */

namespace PhueTest\Command;

use Phue\Command\GetLights;
use Phue\Client;
use Phue\Light;
use Phue\Transport\TransportInterface;

/**
 * Tests for Phue\Command\GetLights
 *
 * @category Phue
 * @package  Phue
 */
class GetLightsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Set up
     *
     * @return void
     */
    public function setUp()
    {
        $this->getLights = new GetLights();

        // Mock transport
        $this->mockTransport = $this->getMockBuilder('\Phue\Transport\TransportInterface')
                                    ->setMethods([
                                        'sendRequest'
                                    ])
                                    ->getMock();

        // Mock client
        $this->mockClient = $this->getMockBuilder('\Phue\Client')
                                 ->setMethods([
                                     'getUsername',
                                     'getTransport'
                                 ])
                                 ->setConstructorArgs([
                                     '127.0.0.1'
                                 ])
                                 ->getMock();

        // Mock client's getUsername method
        $this->mockClient->expects($this->any())
                         ->method('getUsername')
                         ->will($this->returnValue('abcdefabcdef01234567890123456789'));

        // Mock client's getTransport method
        $this->mockClient->expects($this->any())
                         ->method('getTransport')
                         ->will($this->returnValue($this->mockTransport));
    }

    /**
     * Test: Found no lights
     *
     * @covers \Phue\Command\GetLights::send
     */
    public function testFoundNoLights()
    {
        // Mock transport's sendRequest method
        $this->mockTransport->expects($this->once())
                            ->method('sendRequest')
                            ->with($this->equalTo($this->mockClient->getUsername()))
                            ->will($this->returnValue(new \stdClass));

        // Send command and get response
        $response = $this->getLights->send($this->mockClient);

        // Ensure we have an empty array
        $this->assertInternalType('array', $response);
        $this->assertEmpty($response);
    }

    /**
     * Test: Found lights
     *
     * @covers \Phue\Command\GetLights::send
     */
    public function testFoundLights()
    {
        // Mock transport results
        $mockTransportResults = (object) [
            'lights' => [
                1 => new \stdClass,
                2 => new \stdClass,
            ]
        ];

        // Mock transport's sendRequest method
        $this->mockTransport->expects($this->once())
                            ->method('sendRequest')
                            ->with($this->equalTo($this->mockClient->getUsername()))
                            ->will($this->returnValue($mockTransportResults));

        // Send command and get response
        $response = $this->getLights->send($this->mockClient);

        // Ensure we have an array of Lights
        $this->assertInternalType('array', $response);
        $this->assertContainsOnlyInstancesOf('\Phue\Light', $response);
    }
}
