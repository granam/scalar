<?php
namespace Granam\Scalar\Tools;

use Granam\Tools\ValueDescriber;

class ToString
{
    /**
     * @param $value
     * @param bool $strict = true NULL raises an exception
     * @return string
     * @throws \Granam\Scalar\Tools\Exceptions\WrongParameterType
     */
    public static function toString($value, $strict = true)
    {
        if (is_string($value)) {
            return $value;
        }

        if (is_scalar($value)
            || ($value === null && !$strict)
            || (is_object($value) && method_exists($value, '__toString'))
        ) {
            return (string)$value;
        }
        if ($strict) {
            if ($value !== null) {
                $message = 'Expected scalar or object with __toString method, got ' . ValueDescriber::describe($value);
            } else {
                $message = 'In strict mode expected scalar or object with __toString method, got ' . ValueDescriber::describe($value);
            }
        } else {
            $message = 'Expected scalar, NULL or object with __toString method, got ' . ValueDescriber::describe($value);
        }

        throw new Exceptions\WrongParameterType($message);
    }
}