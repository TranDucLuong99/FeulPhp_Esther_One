<?php

class Service_Sendmail
{
    public function send_email_to_user()
    {
        \Package::load('email');

        $email = Email::forge();
        $email->from('tranducluong8899@gmail.com', 'tranducluong');
        $email->to('gowiray612@iminko.com', 'hieptq');
        $email->subject('This is the subject');
        $email->body('This is the body of the email');

        try {
            $email->send();
            echo "Email sent successfully!";
        } catch (\Email\EmailException $e) {
            echo "Failed to send email: " . $e->getMessage();
        }
    }
}