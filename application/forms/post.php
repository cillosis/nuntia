<?php

class Application_Form_Post extends Zend_Form
{
 
    public function init()
    {
        $this->setName('post');
        $this->setMethod('post');
        $this->setAction(APPLICATION_URL . '/post/new');
        
        $title = new Zend_Form_Element_Text('title');
        $title->setAttrib('size',50)
            ->setLabel('Posting Title:')
            ->setRequired(true)
            ->addErrorMessage('Please a title for this post');
        
        $price = new Zend_Form_Element_Text('price');
        $price->setAttrib('size',10)
            ->setLabel('Price:')
            ->setRequired(true)
            ->addErrorMessage('Please provide a price');
        
        $location = new Zend_Form_Element_Text('location');
        $location->setAttrib('size',35)
            ->setLabel('Specific Location:')
            ->setRequired(true)
            ->addErrorMessage('Please provide a location');
                
        $email = new Zend_Form_Element_Text('email');
        $email->setAttrib('size',35)
             ->setLabel('Your Email Address:')
             ->setRequired(true)
             ->addErrorMessage('Please provide a valid email address');
        
        $emailverify = new Zend_Form_Element_Text('emailverify');
        $emailverify->setAttrib('size',35)
             ->setLabel('Verify Email Address:')
             ->setRequired(true)
             ->addErrorMessage('Please validate your email address');
        
        $posting = new Zend_Form_Element_Textarea('posting');
        $posting->setAttrib('rows','12')
             ->setAttrib('cols','75')
             ->setLabel('Posting Description:')
             ->setRequired(true)
             ->addErrorMessage('Please specify the postings description');
        
        $imagebtn = new Zend_Form_Element_Button('imagebtn');
        $imagebtn->setLabel('Add/Edit Images')
                 ->setIgnore(true);
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Continue')
               ->setIgnore(true);
        
        $this->setDecorators(array(
            array('ViewScript', array('viewScript'=>'_form_post.phtml')),
            'Form'
        ));
        
        $this->addElements(array($title,$price,$location,$email,$emailverify,$posting,$imagebtn,$submit));
        
        $this->setElementDecorators(array('ViewHelper'));
      
    }
    
}


?>
