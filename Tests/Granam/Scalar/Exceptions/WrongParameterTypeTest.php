<?php
namespace Granam\Scalar\Exceptions;

class WrongParameterTypeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function Origins_at_standard_runtime_exception()
    {
        throw new WrongParameterType;
    }

    /**
     * @test
     * @expectedException \Granam\Scalar\Exceptions\WrongParameterType
     */
    public function Can_be_thrown()
    {
        throw new WrongParameterType;
    }

    /**
     * @test
     * @expectedException \Granam\Scalar\Exceptions\Runtime
     */
    public function Is_tagged_by_local_runtime()
    {
        throw new WrongParameterType;
    }
}
