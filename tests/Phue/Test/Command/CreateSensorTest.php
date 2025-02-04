<?php
/**
 * Phue: Philips Hue PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2012 Michael K. Squires
 * @license   http://github.com/sqmk/Phue/wiki/License
 */
namespace Phue\Test\Command;

use Mockery;
use PHPUnit\Framework\TestCase;
use Phue\Command\CreateSensor;

/**
 * Tests for Phue\Command\CreateSensor
 */
class CreateSensorTest extends TestCase
{
    /**
     * Test: Instantiating CreateSensor command
     *
     * @covers \Phue\Command\CreateSensor::__construct
     */
    public function testInstantiation(): void
    {
        $command = new CreateSensor('dummy name');
    }

    /**
     * Test: Set name
     *
     * @covers \Phue\Command\CreateSensor::name
     */
    public function testName(): void
    {
        $command = new CreateSensor();
        
        $this->assertEquals($command, $command->name('dummy name'));
    }

    /**
     * Test: Set model Id
     *
     * @covers \Phue\Command\CreateSensor::modelId
     */
    public function testModelId(): void
    {
        $command = new CreateSensor();
        
        $this->assertEquals($command, $command->modelId('modelid'));
    }

    /**
     * Test: Set software version
     *
     * @covers \Phue\Command\CreateSensor::softwareVersion
     */
    public function testSoftwareVersion(): void
    {
        $command = new CreateSensor();
        
        $this->assertEquals($command, $command->softwareVersion('123'));
    }

    /**
     * Test: Set type
     *
     * @covers \Phue\Command\CreateSensor::type
     */
    public function testType(): void
    {
        $command = new CreateSensor();
        
        $this->assertEquals($command, $command->type('sensortype'));
    }

    /**
     * Test: Set unique Id
     *
     * @covers \Phue\Command\CreateSensor::uniqueId
     */
    public function testUniqueId(): void
    {
        $command = new CreateSensor();
        
        $this->assertEquals($command, $command->uniqueId('123.456.789'));
    }

    /**
     * Test: Set manufacturer name
     *
     * @covers \Phue\Command\CreateSensor::manufacturerName
     */
    public function testManufacturerName(): void
    {
        $command = new CreateSensor();
        
        $this->assertEquals($command, $command->manufacturerName('PhueClient'));
    }

    /**
     * Test: Set config attribute
     *
     * @covers \Phue\Command\CreateSensor::configAttribute
     */
    public function testConfigAttribute(): void
    {
        $command = new CreateSensor();
        
        $this->assertEquals($command, $command->configAttribute('key', 'value'));
    }

    /**
     * Test: Set state attribute
     *
     * @covers \Phue\Command\CreateSensor::stateAttribute
     */
    public function testStateAttribute(): void
    {
        $command = new CreateSensor();
        
        $this->assertEquals($command, $command->stateAttribute('key', 'value'));
    }

    /**
     * Test: Send
     *
     * @covers \Phue\Command\CreateSensor::send
     */
    public function testSend(): void
    {
        // Mock client
        $mockClient = Mockery::mock('\Phue\Client', 
            [
                'getUsername' => 'abcdefabcdef01234567890123456789'
            ])->makePartial();
        
        // Mock client commands
        $mockClient->shouldReceive('getTransport->sendRequest')->
        andReturn((object) [
            'id' => '5'
        ]);
        
        $command = (new CreateSensor('test'));
        
        $this->assertEquals('5', $command->send($mockClient));
    }
}
