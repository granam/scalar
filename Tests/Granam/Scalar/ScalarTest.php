<?php
namespace Granam\Scalar;

class ScalarTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function can_create_instance()
    {
        $instance = new Scalar('foo');
        $this->assertNotNull($instance);
    }

    /** @test */
    public function has_local_interface()
    {
        $instance = new Scalar('foo');
        $this->assertInstanceOf('Granam\Scalar\ScalarInterface', $instance);
    }

    /** @test */
    public function can_be_turned_into_string()
    {
        $stringScalar = new Scalar($string = 'foo');
        $this->assertSame($string, (string)$stringScalar);

        $integerScalar = new Scalar($integer = 123456);
        $this->assertSame((string)$integer, (string)$integerScalar);

        $floatScalar = new Scalar($float = 123456.789654);
        $this->assertSame((string)$float, (string)$floatScalar);

        $almostIntegerFloatScalar = new Scalar($almostIntegerFloat = 0.9999999999);
        $this->assertSame((string)$almostIntegerFloat, (string)$almostIntegerFloatScalar);

        $falseScalar = new Scalar($false = false);
        $this->assertSame((string)$false, (string)$falseScalar);

        $trueScalar = new Scalar($true = true);
        $this->assertSame((string)$true, (string)$trueScalar);
    }

    /**
     * @test
     */
    public function with_integer_is_string_with_that_integer()
    {
        $strictScalar = new Scalar($integer = 1);
        $this->assertSame((string)$integer, (string)$strictScalar);
    }
    
    /**
     * @test
     */
    public function with_float_is_string_with_that_float()
    {
        $strictScalar = new Scalar($float = 1.1);
        $this->assertSame((string)$float, (string)$strictScalar);
    }

    /**
     * @test
     */
    public function with_false_is_empty_string()
    {
        $strictString = new Scalar($false = false);
        $this->assertSame((string)$false, (string)$strictString);
        $this->assertSame('', (string)$strictString);
    }
    
    /**
     * @test
     */
    public function with_true_is_string_number_one()
    {
        $strictString = new Scalar($true = true);
        $this->assertSame((string)$true, (string)$strictString);
        $this->assertSame('1', (string)$strictString);
    }

    /**
     * @test
     */
    public function with_null_is_empty_string()
    {
        $strictString = new Scalar($null = null);
        $this->assertSame((string)$null, (string)$strictString);
        $this->assertSame('', (string)$strictString);
    }

    /**
     * @test
     * @expectedException \Granam\Scalar\Exceptions\WrongParameterType
     */
    public function throws_exception_with_array()
    {
        new Scalar([]);
    }

    /**
     * @test
     * @expectedException \Granam\Scalar\Exceptions\WrongParameterType
     */
    public function throws_exception_with_resource()
    {
        new Scalar(tmpfile());
    }

    /**
     * @test
     * @expectedException \Granam\Scalar\Exceptions\WrongParameterType
     */
    public function throws_exception_with_object()
    {
        new Scalar(new \stdClass());
    }

    /**
     * @test
     */
    public function with_to_string_object_is_that_object_value_as_string()
    {
        $strictString = new Scalar(new TestWithToString($string = 'foo'));
        $this->assertSame($string, (string)$strictString);
    }

    /**
     * @test
     */
    public function invalid_casted_to_string_cause_warning()
    {
        $invalidToStringScalar = new TestInvalidToStringScalar('foo', false);
        $errors = [];
        set_error_handler(
            function ($errno) use (&$errors) {
                $errors[] = $errno;
            },
            E_USER_WARNING
        );
        $this->assertEmpty($errors);
        $this->assertSame('', $invalidToStringScalar->__toString());
        restore_error_handler();
        $this->assertNotEmpty($errors);
        $this->assertCount(1, $errors);
        $this->assertSame(E_USER_WARNING, $errors[0]);
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

class TestInvalidToStringScalar extends Scalar
{

    public function __toString()
    {
        $this->value = [];

        return parent::__toString();
    }
}
