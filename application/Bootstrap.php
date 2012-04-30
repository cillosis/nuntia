<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initEnvironment()
    {    
        define('APPLICATION_URL','http://localhost/www/Nuntia/public');       
    }
    
    public function _initErrors()
    {
        error_reporting(E_ALL|E_STRICT);
        ini_set('display_errors','on');
    }
    
    protected function _initAutoload()
    {
        // Add autoloader empty namespace
        $autoLoader = Zend_Loader_Autoloader::getInstance();
        $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
            'basePath'      => APPLICATION_PATH,
            'namespace'     => '',
            'resourceTypes' => array(
                'form' => array(
                    'path' => 'forms/',
                    'namespace' => 'Form_',
                ),
                'model' => array(
                        'path' => 'models/',
                        'namespace' => 'Model_',
                ),
            ),
        ));
        // Return it so that it can be stored by the bootstrap
        return $autoLoader;
    }
	
	protected function _initView()
	{
		$view = new Zend_View();
		$view->setEncoding('UTF-8');
		$view->doctype('XHTML1_STRICT');
		$view->headMeta()->appendHttpEquiv(
			'Content-Type', 'text/html;charset=utf-8'
		);
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
		$viewRenderer->setView($view);
		return $view;
	}
	
	protected function _initRoutes()
	{
		$frontController = Zend_Controller_Front::getInstance();
		$router = $frontController->getRouter();
		                
		// Route: "application/post"  => "application/post/new"
		$router->addRoute(
			'post',
			new Zend_Controller_Router_Route('/post', array('controller' => 'post', 'action' => 'new'))
		);
		
                // Route: "application/post/index" => "application/post/new"
                $router->addRoute(
			'post_index',
			new Zend_Controller_Router_Route('/post/index', array('controller' => 'post', 'action' => 'new'))
		);
    	
                // Route: "application/post/show/:postid"
                $router->addRoute(
			'post_show_postid',
			new Zend_Controller_Router_Route('/post/show/:postid', array('controller' => 'post', 'action' => 'show'))
		);
    	
	}
	
	protected function _initDebugLog()
	{		
		
		// Use FireBug Logger
		//$writer = new Zend_Log_Writer_Firebug();
		
		// Use text file logger
		$writer = new Zend_Log_Writer_Stream(APPLICATION_PATH.'/logs/log.txt');
		$logger = new Zend_Log($writer);
		
		// Add to registry to be used anywhere
		Zend_Registry::set('logger', $logger);
		return $logger;
		
		// To use logger from registry: Zend_Registry::get('logger')->debug('my message here');

	}
}

