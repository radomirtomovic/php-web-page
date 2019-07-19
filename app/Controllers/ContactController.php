<?php


namespace App\Controllers;


use App\Database\Connection;
use App\Mail\Content;
use App\Mail\From;
use App\Mail\SendMail;
use App\Mail\To;
use App\Models\Contact;

class ContactController extends Controller
{
    private $connection;

    public function __construct(Connection $conn)
    {
        $this->connection = $conn;
    }

    public function index()
    {
        $this->view('contact.form');
    }

    public function submit(Contact $object)
    {
        $data = [
            ':name' => $object->name,
            ':surname' => $object->surname,
            ':email' => $object->email,
            ':message' => $object->message,
        ];
        $sql = 'INSERT INTO contacts(first_name, last_name, email, message) VALUES (:name, :surname, :email, :message);';
        $hasInserted = $this->connection->execute($sql, $data, false);
        if ($hasInserted) {
            $to = new To('rtomovic5@gmail.com', 'Radomir Tomovic');
            $content = new Content('Mail from onepage_website', $object->message, true);
            $from = new From($object->email, $object->name . ' ' . $object->surname);
            $mail = new SendMail($to, $from, $content);
            return $mail->send();
        } else {
            return false;
        }

    }
}