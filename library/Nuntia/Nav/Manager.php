<?php

/*
 * @class   Nuntia_Nav_Manager
 */

class Nuntia_Nav_Manager
{
    public $links = array();
    
    // Private dynamic properties array
    // to set/get undefined properties at runtime
    private $dynamicProperties = array();
    
    public function __construct($buttonset = 'primary')
    {
        $navConfig = new Zend_Config_Ini(APPLICATION_PATH . '/configs/navigation.ini', $buttonset);
        foreach($navConfig->button as $button)
        {
             $newlink = new Nuntia_Nav_Link;
             $newlink->title = $button->title;
             $newlink->weight = $button->weight;
             $newlink->url = $button->url;
             // Save link
             $this->links[$button->title] = $newlink;
        }
        // Sort added links by weight
        uasort($this->links,array($this,'_linkSort'));
    }
    
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
    
    public function addLink(Nuntia_Nav_Link $newlink)
    {
        // Add link to manager
        $this->links[$newlink->title] = $newlink;
        
        // Sort by link weight
        if($doSort)
        {
            uasort($this->links,array($this,'_linkSort'));
        }
    }
    
    // Used for sorting of link objects
    protected function _linkSort($a,$b)
    {
        return strcmp($a->weight,$b->weight);
    }
}

?>
