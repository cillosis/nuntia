<?php

require_once('Zend/Db/Table/Abstract.php');

class Application_Model_Categories extends Zend_Db_Table_Abstract
{
    protected $_name = 'categories';
    protected $_primary = 'id';
    private $_cache = null;
    
    /*******************************************************************
    * @method		init()
    * ******************************************************************
    * @param		None	
    * @return		None
    * ******************************************************************
    * Initialize Categories model 
    * *****************************************************************/ 
    public function init()
    {
        // Setup caching
        $frontendOptions = array('lifeTime' => (strtotime('+1 week') - time()), 'automatic_seralization' => true);
        $backendOptions = array('cache_dir' => '../application/cache');
        $this->_cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
    }
    
    /*******************************************************************
    * @method		getById()
    * ******************************************************************
    * @param		Integer		
    * @return		Zend_Db_Table_Row
    * ******************************************************************
    * Search table for single row with matching ID and return it. 
    * *****************************************************************/
    public function getById($id = null) 
    {
            // Query table for ID
            $rowset = $this->find($id);

            // Validate and return row
            if($rowset->current())
            {	
                    // Return current row from rowset
                    return $rowset->current();
            }
            else { return false; }
    }
    
    /*******************************************************************
    * @method		getAll()
    * ******************************************************************
    * @param		Boolean			Allow override of caching mechanism		
    * @return		Zend_Db_Table_Rowset
    * ******************************************************************
    * Search table for all categories and return them.
    * *****************************************************************/ 
    public function getAll($cacheOverride = false) 
    {
        $cache_id = 'all_category_results';

        if ( ($results = $this->_cache->load($cache_id)) === false || $cacheOverride == true)
        {
                // Get all results
                $categories = $this->fetchAll();

                // Convert PDOStatement to array
                //while ($station_row = $stations->fetch()) 
                foreach($categories as $category)
                {
                        $data[] = $category;
                }

                // Serialize data
                $serialized_data = serialize($data);

                // Write to cache
                $this->_cache->save($serialized_data, $cache_id);

                return $data;
        }
        else 
        {

                // Return results from cache
                return unserialize($results);

        }
    }
}

