<?php
namespace Granam\Scalar\Tools;

class ToScalar
{

    /**
     * @param bool|float|int|string|null|object $value
     * @param bool $strict = false
     *
     * @return int|float|null|string
     */
    public static function toScalar($value, $strict = false)
    {
        if (is_scalar($value)) {
            return $value;
        }

        if (is_null($value)) {
            if (!$strict) {
                return $value;
            }
            throw new Exceptions\WrongParameterType(
                'Expected scalar or object with __toString method on strict mode, got ' . ValueDescriber::describe($value)
            );
        }

        return ToString::toString($value);
    }
}
