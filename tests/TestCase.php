<?php
namespace Tests;

class TestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /**
     * Sets the property value (can be protected/private)
     *
     * @param string $propertyName  The name of property
     * @param string $value         The value to set
     * @param object &$object       Instantiated object that we will run method on.
     *
     * @link http://stackoverflow.com/a/18562840/740949
     */
    public function setProperty($propertyName, $value, &$object)
    {
        $reflection = new \ReflectionClass($object);
        $reflection_property = $reflection->getProperty($propertyName);
        $reflection_property->setAccessible(true);

        $reflection_property->setValue($object, $value);
    }
}