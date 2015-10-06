<?php


namespace App\GeneralClasses;

use App\GeneralClasses\Application as App;

class MyMailer
   extends \PHPMailer

{

    public $userlogin;
    public $message;


    public function __construct()
    {

        $this->userlogin = App::getCurrentUserLogin();
        $this->view = new View(__DIR__ . '/../views/users/');

    }


    public function sendMail() {

        date_default_timezone_set('Etc/UTC');

        $this->isSMTP();

    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
        $this->SMTPDebug = 0;

    //Ask for HTML-friendly debug output
        $this->Debugoutput = 'html';

    //Set the hostname of the mail server
        $this->Host = 'smtp.yandex.ru';

    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $this->Port = 465;

    //Set the encryption system to use - ssl (deprecated) or tls
        $this->SMTPSecure = 'ssl';

    //Whether to use SMTP authentication
        $this->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
        $this->Username = "annaalexandrovnas@yandex.ru";

    //Password to use for SMTP authentication
        $this->Password = "8888888888888888888";

    //Set who the message is to be sent from
        $this->setFrom('annaalexandrovnas@yandex.ru', 'Анна Соколова');


    //Set who the message is to be sent to
        $this->addAddress($this->userlogin, '');

    //Set the subject line
        $this->Subject = 'Подтверждение регистрации';

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
        $this->msgHTML(file_get_contents(__DIR__ . '/../data/message.xhtml'), dirname(__FILE__));

    //Replace the plain text body with one created manually
        $this->AltBody = 'Вы зарегистрированы на сайте';

    //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');

        $this->setLanguage('ru', '/vendor/phpmailer/phpmailer/language/');



    //send the message, check for errors
        if (!$this->send()) {
            $this->message = ['message' => 'Произошла ошибка при отправке сообщения.' . $this->ErrorInfo];
            var_dump($this->setLanguage('ru', '/vendor/phpmailer/phpmailer/language/'));
            exit;

        } else {
            $this->message = ['message' => 'Сообщение отправлено'];
        }

    }
    public function showConfirm()
    {
        $this->view->items = $this->message;
        $this->view->display('confirmmailsent');
    }
}
