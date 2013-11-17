<?php

require_once 'Zend/Form.php';
require_once 'Zend/View.php';

class ContactForm extends Zend_Form {
    
    public function init()
    {
        $view = new Zend_View();
        $view->addScriptPath(dirname(__FILE__));
        $this->setView($view);

        $this->addElement('text', 'myname', array(
            'class' => 'span10',
            'required' => true,
            'attribs' => array(
//                'required' => 'required'
            ),
        ));

        $this->addElement('text', 'email', array(
            'class' => 'span10',
            'required' => true,
            'validators' => array('EmailAddress'),
            'attribs' => array(
//                'required' => 'required'
            ),
        ));

        $this->addElement('text', 'subject', array(
            'class' => 'span10',
            'required' => true,
            'attribs' => array(
//                'required' => 'required'
            ),
        ));

        $this->addElement('textarea', 'body', array(
            'class' => 'span10',
            'required' => true,
            'rows' => '5',
            'attribs' => array(
//                'required' => 'required',
            ),
        ));

        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => 'contact-form.phtml'))
        ));

        foreach ($this->getElements() as $element) {
            $element->setView($view);
        }
    }

    public function getRuErrorMessage($key = null)
    {
        $messages = array(
            'isEmpty' => 'Поле не может быть пустым!',
            'emailAddressInvalidFormat' => 'Неверный адрес электронной почты!',
            'emailAddressInvalidHostname' => 'Неверный домен!',
        );

        return $key ? $messages[$key] : $messages;
    }   

}
