<?php

//autoload do composer
require __DIR__.'/vendor/autoload.php';
require_once 'logger.php';

//dependecias
use Google\Client as GoogleClient;
use App\Session\User as SessionUser;

//verifica os campos obrigatorios
if(!isset($_POST['credential']) || !isset($_POST['g_csrf_token'])) {
    header('location: index.php');
    exit;
}

// cookie CSRF
$cookie = $_COOKIE['g_csrf_token'] ?? '';

if($_POST['g_csrf_token'] != $cookie){
    header('location: index.php');
    exit;
}

//validacao secundaria do token
$client = new GoogleClient(['client_id' => 'YOUR_CLIENT_ID']);
$payload = $client->verifyIdToken($_POST['credential']);
if (isset($payload['email'])) {
    SessionUser::login($payload['name'], $payload['email']);
    logger($payload['name'] . " se conectou usando uma conta Google");
    header('location: index.php');
    exit;
}

//Problemas ao consultar API
die('Error-404');
?>
