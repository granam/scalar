<?php
namespace Granam\Scalar\Exceptions;

class RuntimeTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     * @expectedException \Granam\Scalar\Exceptions\Runtime
     */
    public function can_be_thrown()
    {
        throw new Runtime;
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function origins_at_standard_runtime_exception()
    {
        throw new Runtime;
    }

    /**
     * @test
     * @expectedException \Granam\Scalar\Exceptions\Exception
     */
    public function is_marked_by_local_interface()
    {
        throw new Runtime;
    }

    /**
     * @test
     * @expectedException \Granam\Exceptions\Runtime
     */
    public function is_marked_by_granam_runtime_interface()
    {
        throw new Runtime;
    }
}
