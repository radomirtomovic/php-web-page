<?php


namespace App\Controllers;


abstract class Controller
{
    protected function view(string $path):void{
        $path = view($path);
        require_once __DIR__ . '/../../views/layouts/default.php';
    }
}