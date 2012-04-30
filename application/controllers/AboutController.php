<?php

class AboutController extends Zend_Controller_Action
{

    public function init()
    {
        // Initialize navigation
        $nav = new Nuntia_Nav_Manager('primary');
        $nav->links['about']->active = true;
        $this->view->nav = $nav;
    }

    public function indexAction()
    {
        // action body
    }


}

