<?php
/**
 * Phue: Philips Hue PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2012 Michael K. Squires
 * @license   http://github.com/sqmk/Phue/wiki/License
 */
namespace Phue\Test\TimePattern;

use PHPUnit\Framework\TestCase;
use Phue\TimePattern\RandomizedTime;

/**
 * Tests for Phue\TimePattern\RandomizedTime
 */
class RandomizedTimeTest extends TestCase
{
    /**
     * Test: Creating randomized time
     *
     * @covers \Phue\TimePattern\RandomizedTime
     */
    public function testCreateTime(): void
    {
        $this->assertMatchesRegularExpression('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}A01:01:20$/',
            (string) new RandomizedTime('now', 3680));
    }
}
