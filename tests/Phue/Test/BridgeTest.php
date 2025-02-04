<?php
/**
 * Phue: Philips Hue PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2012 Michael K. Squires
 * @license   http://github.com/sqmk/Phue/wiki/License
 */
namespace Phue\Test;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Phue\Bridge;
use Phue\Client;

/**
 * Tests for Phue\Bridge
 */
class BridgeTest extends TestCase
{
    /** @var MockObject&Client $mockClient */
    private $mockClient;
    private Bridge $bridge;
    private object $attributes;

    public function setUp(): void
    {
        // Mock client
        $this->mockClient = $this->createMock('\Phue\Client');
        
        // Build stub attributes
        // $this->attributes = (object) [
        // 'name' => 'Hue Bridge',
        // 'zigbeechannel' => 15,
        // 'mac' => '00:11:22:33:44:55',
        // 'dhcp' => true,
        // 'ipaddress' => '127.0.0.1',
        // 'netmask' => '255.255.255.0',
        // 'gateway' => '10.0.1.0',
        // 'proxyaddress' => '123.123.123.123',
        // 'proxyport' => '999',
        // 'UTC' => 'somedate',
        // 'localtime' => 'someotherdate',
        // 'timezone' => 'UTC',
        // 'whitelist' => [
        // 'abcdefabcdef01234567890123456789' => (object) [
        // 'name' => 'Client name',
        // 'create date' => '12-30-2000',
        // 'last use date' => '12-30-2001',
        // ]
        // ],
        // 'swversion' => '12345',
        // 'apiversion' => '1.5.0',
        // 'swupdate' => (object) [],
        // 'linkbutton' => true,
        // 'portalservices' => false,
        // 'portalconnection' => 'connected',
        // 'portalstate' => (object) [],
        // ];
        $this->attributes = (object) [
            'name' => 'Hue Bridge',
            'zigbeechannel' => 15,
            'mac' => '00:11:22:33:44:55',
            'dhcp' => true,
            'ipaddress' => '127.0.0.1',
            'netmask' => '255.255.255.0',
            'gateway' => '10.0.1.0',
            'proxyaddress' => '123.123.123.123',
            'proxyport' => '999',
            'UTC' => 'somedate',
            'localtime' => 'someotherdate',
            'timezone' => 'UTC',
            'whitelist' => [
                'abcdefabcdef01234567890123456789' => (object) [
                    'name' => 'Client name',
                    'create date' => '12-30-2000',
                    'last use date' => '12-30-2001'
                ]
            ],
            'swversion' => '12345',
            'apiversion' => '1.5.0',
            'swupdate' => (object) [],
            'linkbutton' => true,
            'portalservices' => false,
            'portalconnection' => 'connected',
            'portalstate' => (object) []
        ];
        
        // Create bridge object
        $this->bridge = new Bridge($this->attributes, $this->mockClient);
    }

    /**
     * Test: Getting name
     *
     * @covers \Phue\Bridge::__construct
     * @covers \Phue\Bridge::getName
     */
    public function testGetName(): void
    {
        $this->assertEquals($this->attributes->name, $this->bridge->getName());
    }

    /**
     * Test: Setting name
     *
     * @covers \Phue\Bridge::setName
     */
    public function testSetName(): void
    {
        // Expect client's sendCommand usage
        $this->mockClient->expects($this->once())
            ->method('sendCommand')
            ->with($this->isInstanceOf('\Phue\Command\SetBridgeConfig'))
            ->will($this->returnValue($this->bridge));
        
        // Ensure setName returns self
        $this->assertEquals($this->bridge, $this->bridge->setName('new name'));
        
        // Ensure new name can be retrieved by getName
        $this->assertEquals('new name', $this->bridge->getName());
    }

    /**
     * Test: Getting ZigBee Channel
     *
     * @covers \Phue\Bridge::getZigBeeChannel
     */
    public function testGetZigBeeChannel(): void
    {
        $this->assertEquals($this->attributes->zigbeechannel, 
            $this->bridge->getZigBeeChannel());
    }

    /**
     * Test: Setting ZigBee Channel
     *
     * @covers \Phue\Bridge::setZigBeeChannel
     */
    public function testSetZigBeeChannel(): void
    {
        // Expect client's sendCommand usage
        $this->mockClient->expects($this->once())
            ->method('sendCommand')
            ->with($this->isInstanceOf('\Phue\Command\SetBridgeConfig'))
            ->will($this->returnValue($this->bridge));
        
        // Ensure setZigBeeChannel returns self
        $this->assertEquals($this->bridge, $this->bridge->setZigBeeChannel(10));
        
        // Ensure new value can be retrieved by getZigBeeChannel
        $this->assertEquals(10, $this->bridge->getZigBeeChannel());
    }

    /**
     * Test: Getting MAC address
     *
     * @covers \Phue\Bridge::getMacAddress
     */
    public function testGetMacAddress(): void
    {
        $this->assertEquals($this->attributes->mac, $this->bridge->getMacAddress());
    }

    /**
     * Test: Is DHCP enabled?
     *
     * @covers \Phue\Bridge::isDhcpEnabled
     */
    public function testIsDhcpEnabled(): void
    {
        $this->assertTrue($this->bridge->isDhcpEnabled());
    }

    /**
     * Test: Disabling DHCP
     *
     * @covers \Phue\Bridge::enableDhcp
     */
    public function testEnableDhcp(): void
    {
        // Expect client's sendCommand usage
        $this->mockClient->expects($this->once())
            ->method('sendCommand')
            ->with($this->isInstanceOf('\Phue\Command\SetBridgeConfig'))
            ->will($this->returnValue($this->bridge));
        
        // Ensure enableDhcp returns self
        $this->assertEquals($this->bridge, $this->bridge->enableDhcp(false));
        
        // Ensure new value can be retrieved by isDhcpEnabled
        $this->assertFalse($this->bridge->isDhcpEnabled());
    }

    /**
     * Test: Getting IP Address
     *
     * @covers \Phue\Bridge::getIpAddress
     */
    public function testGetIpAddress(): void
    {
        $this->assertEquals('127.0.0.1', $this->bridge->getIpAddress());
    }

    /**
     * Test: Setting IP Address
     *
     * @covers \Phue\Bridge::setIpAddress
     */
    public function testSetIpAddress(): void
    {
        // Expect client's sendCommand usage
        $this->mockClient->expects($this->once())
            ->method('sendCommand')
            ->with($this->isInstanceOf('\Phue\Command\SetBridgeConfig'))
            ->will($this->returnValue($this->bridge));
        
        // Ensure setIpAddress returns self
        $this->assertEquals($this->bridge, $this->bridge->setIpAddress('127.0.0.1'));
        
        // Ensure new value can be retrieved by getIpAddress
        $this->assertEquals('127.0.0.1', $this->bridge->getIpAddress());
    }

    /**
     * Test: Getting netmask
     *
     * @covers \Phue\Bridge::getNetmask
     */
    public function testGetNetmask(): void
    {
        $this->assertEquals($this->attributes->netmask, $this->bridge->getNetmask());
    }

    /**
     * Test: Setting netmask
     *
     * @covers \Phue\Bridge::setNetmask
     */
    public function testSetNetmask(): void
    {
        // Expect client's sendCommand usage
        $this->mockClient->expects($this->once())
            ->method('sendCommand')
            ->with($this->isInstanceOf('\Phue\Command\SetBridgeConfig'))
            ->will($this->returnValue($this->bridge));
        
        // Ensure setNetmask returns self
        $this->assertEquals($this->bridge, 
            $this->bridge->setNetmask('255.255.255.1'));
        
        // Ensure new value can be retrieved by getNetmask
        $this->assertEquals('255.255.255.1', $this->bridge->getNetmask());
    }

    /**
     * Test: Get gateway
     *
     * @covers \Phue\Bridge::getGateway
     */
    public function testGetGateway(): void
    {
        $this->assertEquals($this->attributes->gateway, $this->bridge->getGateway());
    }

    /**
     * Test: Setting gateway
     *
     * @covers \Phue\Bridge::setGateway
     */
    public function testSetGateway(): void
    {
        // Expect client's sendCommand usage
        $this->mockClient->expects($this->once())
            ->method('sendCommand')
            ->with($this->isInstanceOf('\Phue\Command\SetBridgeConfig'))
            ->will($this->returnValue($this->bridge));
        
        // Ensure setGateway returns self
        $this->assertEquals($this->bridge, $this->bridge->setGateway('10.0.0.1'));
        
        // Ensure new value can be retrieved by getGateway
        $this->assertEquals('10.0.0.1', $this->bridge->getGateway());
    }

    /**
     * Test: Getting proxy address
     *
     * @covers \Phue\Bridge::getProxyAddress
     */
    public function testGetProxyAddress(): void
    {
        $this->assertEquals($this->attributes->proxyaddress, 
            $this->bridge->getProxyAddress());
    }

    /**
     * Test: Setting proxy address
     *
     * @covers \Phue\Bridge::setProxyAddress
     */
    public function testSetProxyAddress(): void
    {
        // Expect client's sendCommand usage
        $this->mockClient->expects($this->once())
            ->method('sendCommand')
            ->with($this->isInstanceOf('\Phue\Command\SetBridgeConfig'))
            ->will($this->returnValue($this->bridge));
        
        // Ensure setProxyAddress returns self
        $this->assertEquals($this->bridge, 
            $this->bridge->setProxyAddress('127.0.0.1'));
        
        // Ensure new value can be retrieved by setProxyAddress
        $this->assertEquals('127.0.0.1', $this->bridge->getProxyAddress());
    }

    /**
     * Test: Getting proxy port
     *
     * @covers \Phue\Bridge::getProxyPort
     */
    public function testGetProxyPort(): void
    {
        $this->assertEquals($this->attributes->proxyport, 
            $this->bridge->getProxyPort());
    }

    /**
     * Test: Setting proxy port
     *
     * @covers \Phue\Bridge::setProxyPort
     */
    public function testSetProxyPort(): void
    {
        // Expect client's sendCommand usage
        $this->mockClient->expects($this->once())
            ->method('sendCommand')
            ->with($this->isInstanceOf('\Phue\Command\SetBridgeConfig'))
            ->will($this->returnValue($this->bridge));
        
        // Ensure setProxyAddress returns self
        $this->assertEquals($this->bridge, $this->bridge->setProxyPort(79));
        
        // Ensure new value can be retrieved by setProxyPort
        $this->assertEquals(79, $this->bridge->getProxyPort());
    }

    /**
     * Test: Getting date
     *
     * @covers \Phue\Bridge::getUtcTime
     */
    public function testGetUtcTime(): void
    {
        $this->assertEquals($this->attributes->UTC, $this->bridge->getUtcTime());
    }

    /**
     * Test: Getting local time
     *
     * @covers \Phue\Bridge::getLocalTime
     */
    public function testGetLocalTime(): void
    {
        $this->assertEquals($this->attributes->localtime, 
            $this->bridge->getLocalTime());
    }

    /**
     * Test: Getting timezone
     *
     * @covers \Phue\Bridge::getTimezone
     */
    public function testGetTimezone(): void
    {
        $this->assertEquals($this->attributes->timezone, 
            $this->bridge->getTimezone());
    }

    /**
     * Test: Setting timezone
     *
     * @covers \Phue\Bridge::setTimezone
     */
    public function testSetTimezone(): void
    {
        // Expect client's sendCommand usage
        $this->mockClient->expects($this->once())
            ->method('sendCommand')
            ->with($this->isInstanceOf('\Phue\Command\SetBridgeConfig'))
            ->will($this->returnValue($this->bridge));
        
        // Ensure setTimezone returns self
        $this->assertEquals($this->bridge, $this->bridge->setTimezone('Antarctica'));
        
        // Ensure new value can be retrieved by getTimezone
        $this->assertEquals('Antarctica', $this->bridge->getTimezone());
    }

    /**
     * Test: Getting software version
     *
     * @covers \Phue\Bridge::getSoftwareVersion
     */
    public function testGetSoftwareVersion(): void
    {
        $this->assertEquals($this->attributes->swversion, 
            $this->bridge->getSoftwareVersion());
    }

    /**
     * Test: Getting API version
     *
     * @covers \Phue\Bridge::getApiVersion
     */
    public function testGetApiVersion(): void
    {
        $this->assertEquals($this->attributes->apiversion, 
            $this->bridge->getApiVersion());
    }

    /**
     * Test: Getting Software Update
     *
     * @covers \Phue\Bridge::getSoftwareUpdate
     */
    public function testGetSoftwareUpdate(): void
    {
        $this->assertInstanceOf('\Phue\SoftwareUpdate', 
            $this->bridge->getSoftwareUpdate());
    }

    /**
     * Test: Is Link Button On?
     *
     * @covers \Phue\Bridge::isLinkButtonOn
     */
    public function testIsLinkButtonOn(): void
    {
        $this->assertTrue($this->bridge->isLinkButtonOn());
    }

    /**
     * Test: Setting link button
     *
     * @covers \Phue\Bridge::setLinkButtonOn
     */
    public function testSetLinkButtonOn(): void
    {
        // Expect client's sendCommand usage
        $this->mockClient->expects($this->once())
            ->method('sendCommand')
            ->with($this->isInstanceOf('\Phue\Command\SetBridgeConfig'))
            ->will($this->returnValue($this->bridge));
        
        // Ensure setLinkButtonOn returns self
        $this->assertEquals($this->bridge, $this->bridge->setLinkButtonOn(false));
        
        // Ensure new value can be retrieved by isLinkButtonOn
        $this->assertEquals(false, $this->bridge->isLinkButtonOn());
    }

    /**
     * Test: Are portal services enabled?
     *
     * @covers \Phue\Bridge::arePortalServicesEnabled
     */
    public function testArePortalServicesEnabled(): void
    {
        $this->assertFalse($this->bridge->arePortalServicesEnabled());
    }

    /**
     * Test: Is portal connected?
     *
     * @covers \Phue\Bridge::isPortalConnected
     */
    public function testIsPortalConnected(): void
    {
        $this->assertTrue($this->bridge->isPortalConnected());
    }

    /**
     * Test: Getting Portal
     *
     * @covers \Phue\Bridge::getPortal
     */
    public function testGetPortal(): void
    {
        $this->assertInstanceOf('\Phue\Portal', $this->bridge->getPortal());
    }
}
