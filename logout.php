<?php

//autoload do composer
require __DIR__.'/vendor/autoload.php';
require_once 'logger.php';

//dependecias
use App\Session\User as SessionUser;

//desloga o usuário
SessionUser::logout();

logger("Usuário desconectou");
//redireciona para home
header('location: index.php');
exit;
?>
