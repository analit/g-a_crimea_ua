<?php

/*
  Plugin Name: G-A Contact form
  Plugin URI: http://akismet.com/?return=true
  Description: Contact form on Zend Framework
  Version: 0.1
  Author: Sergey Garyaga
  Author URI: http://automattic.com/wordpress-plugins/
  License: GPLv2 or later
 */

set_include_path(realpath(dirname(__FILE__) . '/../../../library') . PATH_SEPARATOR . get_include_path());

require_once 'ContactForm.php';
require_once 'Zend/Controller/Action/Helper/FlashMessenger.php';
require_once 'Zend/Mail.php';

$flash = new Zend_Controller_Action_Helper_FlashMessenger();

$form = new ContactForm();

if (count($_POST) && $form->isValid($_POST)) {
    sendMessage($_POST);
    $flash->addMessage("<strong>Ваше сообщение отправлено!</strong><br/>В ближайщее время мы с вами свяжемся ...");
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit();
}

function sendMessage($data)
{
    $mail = new Zend_Mail();
    $mail->setBodyText($data['body']);
    $mail->setFrom($data['email'], $data['myname']);
    $mail->addTo('analit09@mail.ru');
    $mail->setSubject('Message from g-a.crimea.ua');
    $mail->send();
}

add_shortcode('contact-form', function () use ($flash, $form) {

    if (count($flash->getMessages())) {
        $messages = $flash->getMessages();
        $message = sprintf('<div class="alert alert-success">%s</div>', $messages[0]);
        return $message;
    }

    return $form->render();
});
