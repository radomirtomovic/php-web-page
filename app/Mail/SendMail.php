<?php


namespace App\Mail;


use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class SendMail
{
    private $from;
    private $content;
    private $to;

    /**
     * @var PHPMailer
     */
    private static $mailer = null;


    public function __construct(To $to,From $from, Content $content)
    {
        self::getMailer();
        $this->from = $from;
        $this->content = $content;
        $this->to = $to;
    }


    private static function getMailer(): PHPMailer
    {
        if (self::$mailer === null) {
            self::$mailer = new PHPMailer();
            self::$mailer->SMTPDebug = PHP_MAILER_DEBUG_LOG;
            self::$mailer->isSMTP();
            self::$mailer->Host = $_ENV['SMTP_HOST'];
            self::$mailer->SMTPAuth = true;
            self::$mailer->Username = $_ENV['SMTP_USERNAME'];
            self::$mailer->Password = $_ENV['SMTP_PASSWORD'];
            self::$mailer->SMTPSecure = $_ENV['SMTP_SECURE'];
            self::$mailer->Port = $_ENV['SMTP_PORT'];
        }
        return self::$mailer;
    }
    public function send()
    {
        try{
            self::$mailer->setFrom($this->from->getEmail(), $this->from->getName());
            self::$mailer->Subject = $this->content->getSubject();
            self::$mailer->Body = $this->content->getMessage();
            self::$mailer->isHTML($this->content->getIsHTML());
            self::$mailer->addAddress($this->to->getEmail(), $this->to->getName());
            return self::$mailer->send();
        }
        catch (Exception $e){
            var_dump($e);
            return false;
        }
    }
}