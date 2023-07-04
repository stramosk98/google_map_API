<?php
require_once 'vendor/autoload.php';

use Predis\Client;

// Configure a conexão com o Redis
$redis = new Client([
    'scheme' => 'tcp',               // Esquema de conexão (tcp)
    'host'   => '127.0.0.1',         // Endereço do servidor Redis
    'port'   => 6379,                // Porta do servidor Redis
]);

// Recupere as chaves dos marcadores
$markerKeys = $redis->keys('marker:*');

// Recupere os detalhes de cada marcador
$markers = [];
foreach ($markerKeys as $key) {
    $marker = $redis->hgetall($key);
    $markers[] = $marker;
}

// Exiba os detalhes dos marcadores
$data = array();
foreach ($markers as $marker) {
    if ($marker['name'] != '<name>') {
        $data[] = array(
            'name'    => $marker['name'],
            'address' => $marker['address'],
            'lat'     => $marker['lat'],
            'lng'     => $marker['lng'],
            'type'    => $marker['type']
        );
    }
}

// Converte para JSON
$json = json_encode($data);

// Exibe o JSON
echo $json;
?>
