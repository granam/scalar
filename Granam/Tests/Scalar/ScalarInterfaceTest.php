<?php
namespace Granam\Tests\Tools\Scalar;

class ScalarInterfaceTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function interface_exists()
    {
        self::assertTrue(interface_exists('Granam\Scalar\ScalarInterface'));
    }

    /** @test */
    public function has_expected_methods()
    {
        $reflection = new \ReflectionClass('Granam\Scalar\ScalarInterface');
        self::assertTrue($reflection->hasMethod('__toString'));
        $__toString = $reflection->getMethod('__toString');
        self::assertTrue($__toString->isPublic());
        self::assertSame(0, $__toString->getNumberOfParameters());
        self::assertTrue($reflection->hasMethod('getValue'));
        $getValue = $reflection->getMethod('getValue');
        self::assertTrue($getValue->isPublic());
        self::assertSame(0 ,$getValue->getNumberOfParameters());
    }
}
