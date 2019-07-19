<?php


namespace App\Controllers;


use App\Database\Connection;
use App\Models\Contact;
use Dotenv\DotEnv;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class ContactController extends Controller
{

    public function index()
    {
        $this->view('contact.form');
    }

    public function submit(Contact $object, Connection $connection)
    {
//        var_dump($contact);

        $pdo = $connection->getPdo();
        $statement = $pdo->prepare('INSERT INTO contacts(first_name, last_name, email, message) 
                                            VALUES (:name, :surname, :email, :message);');
        if($statement->execute([
            ':name'=> $object->name,
            ':surname' => $object->surname,
            ':email' => $object->email,
            ':message' => $object->message,
        ]))
        {
            try {
                $mail = new PHPMailer();
                $mail->SMTPDebug = 4;                                       // Enable verbose debug output
                $mail->isSMTP();                                            // Set mailer to use SMTP
                $mail->Host       = $_ENV['SMTP_HOST'];  // Specify main and backup SMTP servers
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = $_ENV['SMTP_USERNAME'];                     // SMTP username
                $mail->Password   = $_ENV['SMTP_PASSWORD'];                               // SMTP password
                $mail->SMTPSecure = $_ENV['SMTP_SECURE'];                                  // Enable TLS encryption, `ssl` also accepted
                $mail->Port       = $_ENV['SMTP_PORT'];                                    // TCP port to connect to

                $mail->setFrom($object->email,$object->name . ' ' . $object->surname);
                $mail->addAddress('rtomovic5@gmail.com', 'Radomir Tomovic');
                $mail->Subject = 'Mail from onepage_website';
                $mail->Body = $object->message;
                return $mail->send();
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
        else
        {
            return false;
        }

    }
}