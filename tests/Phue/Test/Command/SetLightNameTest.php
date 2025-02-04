<?php
/**
 * Phue: Philips Hue PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2012 Michael K. Squires
 * @license   http://github.com/sqmk/Phue/wiki/License
 */
namespace Phue\Test\Command;

use PHPUnit\Framework\TestCase;
use Phue\Command\SetLightName;

/**
 * Tests for Phue\Command\SetLightName
 */
class SetLightNameTest extends TestCase
{
    public function setUp(): void
    {
        // Mock client
        $this->mockClient = $this->createMock('\Phue\Client');
        
        // Mock transport
        $this->mockTransport = $this->createMock('\Phue\Transport\TransportInterface');
        
        // Mock light
        $this->mockLight = $this->createMock('\Phue\Light', null, 
            array(
                3,
                new \stdClass(),
                $this->mockClient
            ));
        
        // Stub client's getUsername method
        $this->mockClient->expects($this->any())
            ->method('getUsername')
            ->will($this->returnValue('abcdefabcdef01234567890123456789'));
        
        // Stub client's getTransport method
        $this->mockClient->expects($this->any())
            ->method('getTransport')
            ->will($this->returnValue($this->mockTransport));
    }

    /**
     * Test: Set light name
     *
     * @covers \Phue\Command\SetLightName::__construct
     * @covers \Phue\Command\SetLightName::send
     */
    public function testSend(): void
    {
        // Stub transport's sendRequest usage
        $this->mockTransport->expects($this->once())
            ->method('sendRequest')
            ->with(
            $this->equalTo(
                "/api/{$this->mockClient->getUsername()}/lights/{$this->mockLight->getId()}"), 
            $this->equalTo('PUT'), $this->isInstanceOf('\stdClass'));
        
        $lightname = new SetLightName($this->mockLight, 'Dummy name');
        $lightname->send($this->mockClient);
    }
}
