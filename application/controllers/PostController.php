<?php

class PostController extends Zend_Controller_Action
{

    private $dbPosts = null;
    
    public function init()
    {
        // Initialize navigation
        $nav = new Nuntia_Nav_Manager('primary');
        $nav->links['post']->active = true;
        $this->view->nav = $nav;
        
        // Initialize db
        $this->dbPosts = new Application_Model_Posts;
    }

    public function indexAction()
    {
        
    }

    public function newAction()
    {
        // Assign custom form "Post" to view
        $form = new Application_Form_Post;
        $this->view->postForm = $form;
        
        // Check if form was submitted
        if($this->getRequest()->getPost())
        {
            
            // Grab POST data
            $formData = $this->_request->getPost();
            
            // Validate
            if($form->isValid($formData))
            {
            
                // If we have valid data, insert into database
                $data = array(
                    'title'     => $formData['title'],
                    'price'     => $formData['price'],
                    'location'  => $formData['location'],
                    'email'     => $formData['email'],
                    'post'      => $formData['posting']
                );
                $this->dbPosts->insert($data);
                
                // Redirect to success message
                header('Location: ' . APPLICATION_URL . '/post/success');
            
            } else
            {
                
                // Set flag in form that validation failed
                $this->view->hasFormErrors = true;
                
            }
        }
    }

    public function showAction()
    {
        // If we have a parameter in url like "/show/1"
        if($postid = $this->getRequest()->getParam("postid"))
        {
            
            // Get that post and give it to the view
            $this->view->post = $this->dbPosts->getById($postid);
            
        }
    }

    public function deleteAction()
    {
        // Delete post using GET parameters that uniquely
        // identify the post and the submitter. The nonce
        // value is generated randomly and emailed to submitter
        // upon submission. They are the only person who knows
        // what it is
        // /post/delete/?id=1&nonce=JHGJ1K2G3JHG2G1312312J3GGP88YKSJDH71H
    }

    public function successAction()
    {
        // Show success of form submission
    }


}









