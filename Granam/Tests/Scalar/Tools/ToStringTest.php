<?php
namespace Granam\Tests\Scalar\Tools;

use Granam\Scalar\Tools\ToString;

class ToStringTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider provideScalarValue
     * @param $scalarValue
     */
    public function I_get_scalar_values_as_string($scalarValue)
    {
        self::assertSame((string)$scalarValue, ToString::toString($scalarValue /* default */));
        self::assertSame((string)$scalarValue, ToString::toString($scalarValue, true /* strict */));
        self::assertSame((string)$scalarValue, ToString::toString($scalarValue, false /* not strict */));
    }

    public function provideScalarValue()
    {
        return [
            ['foo'],
            [123456],
            [123456.789876],
            [0.999999999],
            [PHP_INT_MAX],
            [false],
            [true],
            [0],
            [''],
        ];
    }

    /**
     * @test
     */
    public function I_get_empty_string_from_null_if_not_strict()
    {
        self::assertSame('', ToString::toString(null, false /* not strict */));
    }

    /**
     * @test
     * @expectedException \Granam\Scalar\Tools\Exceptions\WrongParameterType
     * @expectedExceptionMessageRegExp ~^In strict mode .+got NULL$~
     */
    public function I_cannot_pass_through_with_null_by_default()
    {
        ToString::toString(null);
    }

    /**
     * @test
     * @expectedException \Granam\Scalar\Tools\Exceptions\WrongParameterType
     * @expectedExceptionMessageRegExp ~In strict mode .+got NULL$~
     */
    public function I_cannot_pass_through_with_null_if_strict()
    {
        ToString::toString(null, true /* strict */);
    }

    /**
     * @test
     * @expectedException \Granam\Scalar\Tools\Exceptions\WrongParameterType
     * @expectedExceptionMessageRegExp ~^Expected .+got array$~
     */
    public function Throws_exception_with_array()
    {
        ToString::toString([]);
    }

    /**
     * @test
     * @expectedException \Granam\Scalar\Tools\Exceptions\WrongParameterType
     * @expectedExceptionMessageRegExp ~got resource$~
     */
    public function Throws_exception_with_resource()
    {
        ToString::toString(tmpfile());
    }

    /**
     * @test
     * @expectedException \Granam\Scalar\Tools\Exceptions\WrongParameterType
     * @expectedExceptionMessageRegExp ~got instance of stdClass$~
     */
    public function Throws_exception_with_object()
    {
        ToString::toString(new \stdClass());
    }

    /**
     * @test
     */
    public function I_get_value_from_to_string_object()
    {
        $objectWithToString = new TestObjectWithToString($string = 'foo');
        self::assertSame($string, ToString::toString($objectWithToString));
    }

}