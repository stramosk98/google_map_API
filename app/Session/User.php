<?php

namespace App\Session;

class User{

/**
 * Método responsável por iniciar a sessão dentro da aplicação
 * @return boolean
 */
private static function init() {
    return session_status() !== PHP_SESSION_ACTIVE ? session_start() : true;
}

/**
 * Método responsável por definir a sessão do login do usuário
 * @param string $name
 * @param string $email
 */
public static function login($name, $email) {
    //inicia a sessão da aplicação
    self::init();

    //define a sessão do usuário
    $_SESSION['user'] = [
        'name'  => $name,
        'email' => $email
    ];
}

/**
 * Método responsável por verificar se o usuário está logado
 * @return boolean
 */
public static function isLogged() {
    //inicia a sessão da aplicação
    self::init();

    //Retorna a existência do indice User na sessão
    return isset($_SESSION['user']);
}

/**
 * Método responsável por deslogar o usuário
 */
public static function logout() {
    //inicia a sessão da aplicação
    self::init();

    //remove a sessão do usuário
    unset($_SESSION['user']);
}

}

?>