<?php

namespace MagicObject\Database;

use MagicObject\Exceptions\NoRecordFoundException;
use MagicObject\MagicObject;

/**
 * Database persistence extended
 * @link https://github.com/Planetbiru/MagicObject
 */
class PicoDatabasePersistenceExtended extends PicoDatabasePersistence
{
    /**
     * Magic method to handle undefined methods for setting properties.
     *
     * This method dynamically handles method calls that start with "set".
     * It allows setting properties of the object in a more flexible way,
     * using a consistent naming convention.
     *
     * Supported dynamic method:
     *
     * - `set<PropertyName>`: Sets the value of the specified property.
     *   - If the property name follows "set", the method extracts the property name
     *     and assigns the provided value to it.
     *   - If no value is provided, it sets the property to null.
     *   - Example: `$obj->setFoo($value)` sets the property `foo` to `$value`.
     * 
     * @param string $method The name of the method that was called.
     * @param mixed[] $params The parameters passed to the method, expected to be an array.
     * @return $this Returns the current instance for method chaining.
     */
    public function __call($method, $params)
    {
        if (strlen($method) > 3 && strncasecmp($method, "set", 3) === 0 && isset($params) && is_array($params)){
            $var = lcfirst(substr($method, 3));
            if(empty($params))
            {
                $params[0] = null;
            }
            $this->object->set($var, $params[0]);
            return $this;
        }
    }

    /**
     * Select one record
     *
     * @return MagicObject
     */
    public function select()
    {
        $result = parent::select();
        if($result == null)
        {
            throw new NoRecordFoundException(parent::MESSAGE_NO_RECORD_FOUND);
        }
        $entity = new $this->className(null, $this->database);
        $entity->loadData($result);
        return $entity;
    }

    /**
     * Select all record
     *
     * @return MagicObject[]
     */
    public function selectAll()
    {
        $collection = array();
        $result = parent::selectAll();

        if($result == null || empty($result))
        {
            throw new NoRecordFoundException(parent::MESSAGE_NO_RECORD_FOUND);
        }
        foreach($result as $data)
        {
            $entity = new $this->className(null, $this->database);
            $entity->loadData($data);
            $collection[] = $entity;
        }
        return $collection;
    }
}