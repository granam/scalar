<?php
namespace Granam\Scalar;

class ScalarInterfaceTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function interface_exists()
    {
        $this->assertTrue(interface_exists('Granam\Scalar\ScalarInterface'));
    }

    /** @test */
    public function has_expected_methods()
    {
        $reflection = new \ReflectionClass('Granam\Scalar\ScalarInterface');
        $this->assertTrue($reflection->hasMethod('__toString'));
        $__toString = $reflection->getMethod('__toString');
        $this->assertTrue($__toString->isPublic());
        $this->assertSame(0, $__toString->getNumberOfParameters());
        $this->assertTrue($reflection->hasMethod('getValue'));
        $getValue = $reflection->getMethod('getValue');
        $this->assertTrue($getValue->isPublic());
        $this->assertSame(0 ,$getValue->getNumberOfParameters());
    }
}
