<?php
namespace Granam\Scalar\Tools;

use Granam\Strict\Object\StrictObject;

class ValueDescriberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ValueDescriber
     */
    private $describer;

    protected function setUp()
    {
        $this->describer = new ValueDescriber();
    }

    /**
     * @test
     */
    public function I_can_describe_scalar_and_null()
    {
        $this->assertSame('123', $this->describer->describe(123));
        $this->assertSame('123.456', $this->describer->describe(123.456));
        $this->assertSame("'foo'", $this->describer->describe('foo'));
        $this->assertSame('NULL', $this->describer->describe(null));
        $this->assertSame('true', $this->describer->describe(true));
    }

    /**
     * @test
     */
    public function I_can_describe_object()
    {
        $this->assertSame('instance of stdClass', $this->describer->describe(new \stdClass()));
        $value = 'foo';
        $this->assertSame(
            'instance of ' . ToStringObject::getClass() . " ($value)",
            $this->describer->describe(new ToStringObject($value))
        );
    }

    /**
     * @test
     */
    public function I_can_describe_array_and_resource()
    {
        $this->assertSame('array', $this->describer->describe([]));
        $this->assertSame('resource', $this->describer->describe(tmpfile()));
    }
}

/** inner */
class ToStringObject extends StrictObject
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
