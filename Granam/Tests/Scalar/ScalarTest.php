<?php
namespace Granam\Tests\Tools\Scalar;

use Granam\Scalar\Scalar;

class ScalarTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function can_create_instance()
    {
        $instance = new Scalar('foo');
        self::assertNotNull($instance);
    }

    /** @test */
    public function has_local_interface()
    {
        $instance = new Scalar('foo');
        self::assertInstanceOf('Granam\Scalar\ScalarInterface', $instance);
    }

    /** @test */
    public function can_be_turned_into_string()
    {
        $stringScalar = new Scalar($string = 'foo');
        self::assertSame($string, (string)$stringScalar);

        $integerScalar = new Scalar($integer = 123456);
        self::assertSame((string)$integer, (string)$integerScalar);

        $floatScalar = new Scalar($float = 123456.789654);
        self::assertSame((string)$float, (string)$floatScalar);

        $almostIntegerFloatScalar = new Scalar($almostIntegerFloat = 0.9999999999);
        self::assertSame((string)$almostIntegerFloat, (string)$almostIntegerFloatScalar);

        $falseScalar = new Scalar($false = false);
        self::assertSame((string)$false, (string)$falseScalar);

        $trueScalar = new Scalar($true = true);
        self::assertSame((string)$true, (string)$trueScalar);
    }

    /**
     * @test
     */
    public function I_can_use_it_with_integer()
    {
        $withInteger = new Scalar($integerValue = 1);
        self::assertSame($integerValue, $withInteger->getValue());
        self::assertSame((string)$integerValue, (string)$withInteger);
    }
    
    /**
     * @test
     */
    public function I_can_use_it_with_float()
    {
        $withFloat = new Scalar($floatValue = 1.1);
        self::assertSame($floatValue, $withFloat->getValue());
        self::assertSame((string)$floatValue, (string)$withFloat);
    }

    /**
     * @test
     */
    public function I_can_use_it_with_false()
    {
        $withFalse = new Scalar($false = false);
        self::assertSame(false, $withFalse->getValue());
        self::assertSame((string)$false, (string)$withFalse);
        self::assertSame('', (string)$withFalse);
    }
    
    /**
     * @test
     */
    public function I_can_use_it_with_true()
    {
        $withTrue = new Scalar($true = true);
        self::assertSame($true, $withTrue->getValue());
        self::assertSame((string)$true, (string)$withTrue);
        self::assertSame('1', (string)$withTrue);
    }

    /**
     * @test
     */
    public function I_can_use_it_with_null()
    {
        $withNull = new Scalar($null = null);
        self::assertSame($null, $withNull->getValue());
        self::assertSame((string)$null, (string)$withNull);
        self::assertSame('', (string)$withNull);
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
    public function I_can_use_it_with_to_string_object()
    {
        $strictString = new Scalar(new TestWithToString($stringValue = 'foo'));
        self::assertSame($stringValue, (string)$strictString);
    }

    /**
     * @test
     */
    public function invalid_casted_to_string_cause_warning()
    {
        $invalidToStringScalar = new TestInvalidToStringScalar('foo', false);
        $errors = [];
        set_error_handler(
            function ($errorNumber) use (&$errors) {
                $errors[] = $errorNumber;
            },
            E_USER_WARNING
        );
        self::assertEmpty($errors);
        self::assertSame('', (string)$invalidToStringScalar);
        restore_error_handler();
        self::assertNotEmpty($errors);
        self::assertCount(1, $errors);
        self::assertSame(E_USER_WARNING, $errors[0]);
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
