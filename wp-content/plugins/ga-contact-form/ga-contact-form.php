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
require_once 'Zend/Mail/Transport/Smtp.php';

$flash = new Zend_Controller_Action_Helper_FlashMessenger();

$form = new ContactForm();

if (count($_POST) && $form->isValid($_POST)) {
    try {
        sendMessage($_POST);
    } catch (Exception $exc) {
        $message = "<pre>Ошибка при отправке почты!</pre>";
        $message .= "<pre>" . $exc->getMessage() . " \n\n" . $exc->getTraceAsString() . "</pre>";
    }

    $message = isset($message) ? $message : "<strong>Ваше сообщение отправлено!</strong><br/>В ближайщее время мы с вами свяжемся ...";

    $flash->addMessage($message);
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit();
}

function sendMessage($data)
{
    $message = "User name: " . $data['myname'] . "\n";
    $message .= "User e-mail: " . $data['email'] . "\n";
    $message .= "User message: " . $data['body'] . "\n";

    $mail = new Zend_Mail('utf8');
    $mail->setBodyText($message);
    $mail->setFrom('sergei.garyaga@yandex.ua', 'g-a.crimea.ua');
    $mail->addTo('analit09@mail.ru');
    $mail->setSubject($data['subject']);
    $mail->send();

}

function sendMessageYandex($data)
{
    $config = array(
        'auth' => 'login',
        'username' => 'sergei.garyaga@yandex.ua',
        'password' => '285285285',
        'port' => 25
    );

    $transport = new Zend_Mail_Transport_Smtp('smtp.yandex.ru', $config);
    
    $message = "User name: " .$data['myname']."\n";
    $message .= "User e-mail: " .$data['email']."\n";
    $message .= "User message: " .$data['body']."\n";

    $mail = new Zend_Mail('utf8');
    $mail->setBodyText($message);
    $mail->setFrom('sergei.garyaga@yandex.ua', 'g-a.crimea.ua');
    $mail->addTo('analit09@mail.ru');
    $mail->setSubject($data['subject']);
    $mail->send($transport);
}

add_shortcode('contact-form', function () use ($flash, $form) {

    if (count($flash->getMessages())) {
        $messages = $flash->getMessages();
        $message = sprintf('<div class="alert alert-success">%s</div>', $messages[0]);
        return $message;
    }

    return $form->render();
});
