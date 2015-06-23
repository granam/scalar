<?php
namespace Granam\Scalar\Tools;

class ValueDescriber
{
    /**
     * @param mixed $value
     *
     * @return string
     */
    public static function describe($value)
    {
        if (is_scalar($value) || is_null($value)) {
            return var_export($value, true);
        }

        if (is_object($value)) {
            return 'instance of ' . get_class($value);
        }

        return gettype($value);
    }
}
