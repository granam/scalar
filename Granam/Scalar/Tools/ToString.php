<?php
namespace Granam\Scalar\Tools;

use Granam\Tools\ValueDescriber;

class ToString
{
    /**
     * @param $value
     * @return string
     */
    public static function toString($value)
    {
        if (is_string($value)) {
            return $value;
        }

        if (is_scalar($value) || $value === null || (is_object($value) && method_exists($value, '__toString'))) {
            return (string)$value;
        }

        throw new Exceptions\WrongParameterType(
            'Expected scalar or object with __toString method, got ' . ValueDescriber::describe($value)
        );
    }
}
