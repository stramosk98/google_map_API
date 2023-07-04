<?php

require_once(dirname(__FILE__) . '/vendor/autoload.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

function logger($mensagem, $modo = 'info')
{
    $logger = new Logger('logs');
    $logger->pushHandler(new StreamHandler(dirname(__FILE__) . '/logs.txt'));

    switch ($modo) {
        case 'info':
            $logger->info($mensagem);
            break;
        case 'warning':
            $logger->warning($mensagem);
            break;
        case 'error':
            $logger->error($mensagem);
            break;
        case 'debug':
            $logger->debug($mensagem);
            break;
        case 'notice':
            $logger->notice($mensagem);
            break;
        case 'critical':
            $logger->critical($mensagem);
            break;
        case 'alert':
            $logger->alert($mensagem);
            break;
        case 'emergency':
            $logger->emergency($mensagem);
            break;
        default:
            $logger->info($mensagem);
            break;
    }
}


?>