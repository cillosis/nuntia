<?php

/*
 * @class   Nuntia_Nav_Link
 * @author  Jeremy Harris
 * @date    March 19, 2012
 */

class Nuntia_Nav_Link
{
    // Public configurable properties
    public $title = "";
    public $weight = 0;
    public $active = false;
    public $url = "";
    
    // Private dynamic properties array
    // to set/get undefined properties at runtime
    private $dynamicProperties = array();
    
    public function __set($property, $value)
    {
        // Save undefined class properties
        $this->dynamicProperties[$property] = $value;
    }

    public function __get($property)
    {
        // Get undefined class properties
        if( isset($this->dynamicProperties[$property]) )
        {
                return $this->dynamicProperties[$property];
        } else {
                return null;
        }
    }
    
    public function __isset($name)
    {
        return isset($this->dynamicProperties[$name]);
    }
    
}

?>
