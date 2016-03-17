<?php
namespace Granam\Tests\Scalar\Tools;

use Granam\Scalar\Scalar;
use Granam\Tests\Exceptions\Tools\AbstractExceptionsHierarchyTest;

class ExceptionsHierarchyTest extends AbstractExceptionsHierarchyTest
{
    protected function getTestedNamespace()
    {
        return str_replace('\Tests', '', __NAMESPACE__);
    }

    protected function getRootNamespace()
    {
        $rootReflection = new \ReflectionClass(Scalar::getClass());

        return $rootReflection->getNamespaceName();
    }

}
