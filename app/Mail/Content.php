<?php


namespace App\Mail;


class Content
{
    private $subject;
    private $message;
    private $isHTML;


    public function __construct($subject, $message, $isHTML)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->isHTML = $isHTML;
    }


    public function getIsHTML()
    {
        return $this->isHTML;
    }


    public function getMessage()
    {
        return $this->message;
    }


    public function getSubject()
    {
        return $this->subject;
    }
}
