<?php
namespace Granam\Scalar\Exceptions;

class WrongParameterTypeTest extends RuntimeTest {

    /**
     * @test
     * @expectedException \Granam\Scalar\Exceptions\WrongParameterType
     */
    public function can_be_thrown()
    {
        throw new WrongParameterType;
    }

    /**
     * @test
     * @expectedException \Granam\Scalar\Exceptions\Runtime
     */
    public function is_based_on_local_runtime_exception()
    {
        throw new WrongParameterType;
    }
}
