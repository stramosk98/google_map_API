<?php
session_start();
ob_start();
// include_once("conexao.php");
require_once 'vendor/autoload.php';
require_once 'logger.php';

use Predis\Client;

// Configure a conexão com o Redis
$redis = new Client([
    'scheme' => 'tcp',               // Esquema de conexão (tcp)
    'host'   => '127.0.0.1',         // Endereço do servidor Redis
    'port'   => 6379,                // Porta do servidor Redis
]);

// Recupere as chaves dos marcadores
$markerKeys = $redis->keys('marker:*');

// Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Verifica se o Id já existe no banco
$bIdExistente = false;
foreach($markerKeys as $key => $value){
    if($key == $dados['id']){
        $bIdExistente = true;
    }
}

if(!$bIdExistente){
    // Separa os valores de Latitude e Longitude
    $latLng = $dados['lat_lng'];
    $aLatLng = explode(',', $latLng);
    
    // Remove os espaços e inclui em variaveis
    $lat = trim($aLatLng[0]);
    $lng = trim($aLatLng[1]);

    // Salvar os dados no banco
    $redis->hmset("marker:".$dados['id'], [
        'name'    => 'Abastecimento Eletrico',
        'address' => $dados['address'],
        'lat'     => $lat,
        'lng'     => $lng,
        'type'    => 'Electric Charging Station'
    ]);

    logger('Coordenada cadastrada com sucesso!');
    $_SESSION['msg'] = "<
    3 style='color: green';>Coordenada cadastrada com sucesso!</span>";
    header("Location: cadastrar.php");
} else {
    logger('Error ao cadastrar a coordenada');
    $_SESSION['msg'] = "<span style='color: red';>Erro: Id Existente!</span>";
 	header("Location: cadastrar.php");
 }

?>

