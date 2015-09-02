<?php
namespace Granam\Scalar\Tools;

class ToScalarTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function Scalar_values_remain_untouched()
    {
        $this->assertSame('foo', ToScalar::toScalar('foo'));
        $this->assertSame('foo', ToScalar::toScalar('foo', true /* strict */));
        $this->assertSame(123456, ToScalar::toScalar(123456));
        $this->assertSame(123456, ToScalar::toScalar(123456, true /* strict */));
        $this->assertSame(123456.789654, ToScalar::toScalar(123456.789654));
        $this->assertSame(123456.789654, ToScalar::toScalar(123456.789654, true /* strict */));
        $this->assertSame(0.9999999999, ToScalar::toScalar(0.9999999999));
        $this->assertSame(0.9999999999, ToScalar::toScalar(0.9999999999, true /* strict */));
        $this->assertSame(false, ToScalar::toScalar(false));
        $this->assertSame(false, ToScalar::toScalar(false, true /* strict */));
        $this->assertSame(true, ToScalar::toScalar(true));
        $this->assertSame(true, ToScalar::toScalar(true, true /* strict */));
    }

    /**
     * @test
     */
    public function I_can_pass_through_with_null_if_not_strict()
    {
        $this->assertSame(null, ToScalar::toScalar(null));
    }

    /**
     * @test
     * @expectedException \Granam\Scalar\Tools\Exceptions\WrongParameterType
     * @expectedExceptionMessageRegExp ~got NULL$~
     */
    public function I_cannot_pass_through_with_null_if_strict()
    {
        ToScalar::toScalar(null, true /* strict */);
    }

    /**
     * @test
     * @expectedException \Granam\Scalar\Tools\Exceptions\WrongParameterType
     */
    public function Throws_exception_with_array()
    {
        ToScalar::toScalar([]);
    }

    /**
     * @test
     * @expectedException \Granam\Scalar\Tools\Exceptions\WrongParameterType
     */
    public function Throws_exception_with_resource()
    {
        ToScalar::toScalar(tmpfile());
    }

    /**
     * @test
     * @expectedException \Granam\Scalar\Tools\Exceptions\WrongParameterType
     */
    public function Throws_exception_with_object()
    {
        ToScalar::toScalar(new \stdClass());
    }

    /**
     * @test
     */
    public function with_to_string_object_is_that_object_value_as_string()
    {
        $objectWithToString = new TestWithToString($string = 'foo');
        $this->assertSame($string, ToScalar::toScalar($objectWithToString));
    }

}

/** inner */
class TestWithToString
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return (string)$this->value;
    }
}
