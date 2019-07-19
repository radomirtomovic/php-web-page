<?php
define('PHP_MAILER_DEBUG_LOG', 0);


use App\Controllers\ContactController;
use App\Database\Connection;
use App\Models\Contact;
use App\Models\Register;

require_once __DIR__ . '/../vendor/autoload.php';
$dotEnv = Dotenv\Dotenv::create(__DIR__ . '/../');
$dotEnv->load();

require_once __DIR__ . '/../helper.php';
$urlPath = $_GET['page'] ?? 'index';
$connection = new Connection();
switch ($urlPath) {
    case 'index':
        $contact = new ContactController($connection);
        $contact->index();
        break;
    case 'submit':
        $contact = new ContactController($connection);
        $model = new Contact();

        if (!isset($_POST['submit'])) {
            die('Form must be submitted');
        }

        if (strtolower($_SERVER['REQUEST_METHOD']) !== 'post') {
            die('Method must be post');
        }

        $model->name = $_POST['name'];
        $model->surname = $_POST['surname'];
        $model->email = $_POST['email'];
        $model->message = $_POST['message'];

        if (!$contact->submit($model)) {
            echo 'Error';
        } else {
            echo 'Your data has been inserted successfully';
        }

        break;
    case 'register':
        $login = new ContactController($connection);
        $model = new Register();
        if (!isset($_POST['submit'])) {
            die('Form must be submitted');
        }

        if (strtolower($_SERVER['REQUEST_METHOD']) !== 'post') {
            die('Method must be post');
        }


        break;

    default:
        $path = view('errors.404');
        require_once __DIR__ . '/../views/layouts/default.php';
        break;
}