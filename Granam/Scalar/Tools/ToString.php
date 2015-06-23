<?php
namespace Granam\Scalar\Tools;

class ToString
{
    public static function toString($value)
    {
        if (is_string($value)) {
            return $value;
        }

        if (is_scalar($value) || is_null($value) || (is_object($value) && method_exists($value, '__toString'))) {
            return (string)$value;
        }

        throw new Exceptions\WrongParameterType('Expected scalar, null or to string object, got ' . gettype($value));
    }
}
