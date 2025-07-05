<?php

namespace Tests\Traits;

use ReflectionMethod;
use PHPUnit\Framework\Attributes\DataProvider;

trait MethodsTestTrait
{
    #[DataProvider('methodsDataProvider')]
    public function test_methods_visible(
        string $method_name,
        int $visibility,
        ?string $class_name = null,
    ) {
        if (blank($class_name)) {
            $class_name = $this->class_name;
        }
        $method = new ReflectionMethod($class_name, $method_name);

        switch ($visibility) {
            case ReflectionMethod::IS_PUBLIC:
                $this->assertTrue($method->isPublic());
                break;

            case ReflectionMethod::IS_PRIVATE:
                $this->assertTrue($method->isPrivate());
                break;
            case ReflectionMethod::IS_PROTECTED:
                $this->assertTrue($method->isProtected());
                break;
        }
    }
}
