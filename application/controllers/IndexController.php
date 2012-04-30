<?php

class IndexController extends Zend_Controller_Action
{
    
    private $dbCategories = null;
    private $dbPosts = null;
    
    public function init()
    {
        // Initialize navigation
        $nav = new Nuntia_Nav_Manager('primary');
        $nav->links['home']->active = true;
        $this->view->nav = $nav;    
        
        
        // Initialize database models
        $this->dbCategories = new Application_Model_Categories;
        $this->dbPosts = new Application_Model_Posts;
    }

    public function indexAction()
    {
        
        // Active link in navigation
        $this->view->activelink = 'home';
        
        // Grab all categories for display in view
        $categories = $this->dbCategories->getAll(true);
        $this->view->categories = $categories;
        
        // Grab recent posts for display in view
        $posts = $this->dbPosts->getRecent(5);
        $this->view->recent_posts = $posts;
        
    }


}

