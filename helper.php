<?php declare(strict_types = 1);
function loadFixed(string $fileName){
    require_once __DIR__ . '/views/fixed/' . $fileName . '.php';
}
function view(string $path){
    return __DIR__ . '/views/' . replaceDot($path) . '.php';
}

//C:\xampp\htdocs\blog\views\fixed\header.php\


//contact.form
function replaceDot (string $to, string $replacement = '/'): string {
    $replaced = $to;
    for($i = 0; $i < mb_strlen($replaced); $i++){
        if($replaced[$i] === '.') {
            $replaced[$i] = $replacement;
        }
    }
    return $replaced;
}