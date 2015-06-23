# Wrapping object for scalar (or null) only

[![Build Status](https://travis-ci.org/jaroslavtyc/granam-scalar.svg?branch=master)](https://travis-ci.org/jaroslavtyc/granam-scalar)

PHP provide scalar type hinting since [PHP 7.0](https://wiki.php.net/rfc/scalar_type_hints#proposed_php_version_s).
That is still quite far.
And no native function is able to cast or sanitize a value to scalar with error on value lost.

For that reason, if we want to be sure about scalar type, a scalar converter and optionally a type-checking class are the only chance.

Warning: The converter and so the wrapper class do not cast null - it remains null.

```php
<?php
namespace Granam\Scalar;

$scalar = new Scalar('foo');

// foo
echo $scalar;

$nullScalar = new Scalar(null);
// false
echo is_scalar($nullScalar->getValue());
// true
echo is_null($nullScalar->getValue());

// NULL
var_dump(ToScalar::toScalar(null);

try {
  Tools\ToScalar(null, true /* explicitly strict */);
} catch (Tools\Exceptions\WrongParameterType $scalarException) {
  // Something get wrong: Expected scalar or object with __toString method on strict mode, got NULL.
  die('Something get wrong: ' . $scalarException->getMessage());
}
```

Why the NULL remains NULL by default? Because it is the lesser evil, to do not force a type to an unknown value (which NULL is - the "unknown").
If you want to be sure about scalar type, use [StrictScalar](https://github.com/jaroslavtyc/granam-strict-scalar) instead.
But still, the NULL to scalar cast have to be done by *you*.
