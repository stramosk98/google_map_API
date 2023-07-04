<?php
//AUTOLOAD DE CLASSES DO COMPOSER

require __DIR__.'/vendor/autoload.php';
use \App\Session\User as SessionUser;


//botao login
include SessionUser::isLogged() ? 
    __DIR__.'/map.php' :
    __DIR__.'/includes/login.php';

