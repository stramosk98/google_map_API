<?php
session_start();
// include_once("conexao.php");
require_once 'vendor/autoload.php';

use Predis\Client;

// Configure a conexão com o Redis
$redis = new Client([
    'scheme' => 'tcp',               // Esquema de conexão (tcp)
    'host'   => '127.0.0.1',         // Endereço do servidor Redis
    'port'   => 6379,                // Porta do servidor Redis
]);
?>
<!DOCTYPE html>
  <head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<title>Cadastrar</title>
	</head>
	<body>
		<a href="index.php">Mapa</a><br><br>
		<?php
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?>
		<form method="POST" action="processa_cad.php">
			
			<label>Id: </label>
			<input type="text" class='form-control' placeholder= "0" style='width:30px' required name="id" id="id"><br><br>

			<label>Nome: </label>
			<input type="text" class='form-control' placeholder="Abastecimento Elétrico" readonly name="name" disabled ><br><br>
			
			<label>Endereço: </label>
			<input type="text" name="address" required placeholder="Digite o Endereço"><br><br>
			
			<label>Lat/Lng: </label>
			<input type="text" name="lat_lng" required placeholder="Digite a lat/lng"><br><br>

			<label>Tipo: </label>
			<input type="text" class='form-control' placeholder="Electric Charging Station" readonly name="tipo" disabled ><br><br>
		
			<input type="submit" value="Cadastrar"><br><br>
			<h2><strong>Coordenadas Incluídas:</strong></h2>
		</form>
	</body>
</html>
<?php

// Recupere as chaves dos marcadores
$markerKeys = $redis->keys('marker:*');

// Recupere os detalhes de cada marcador
$markers = [];
foreach ($markerKeys as $key) {
    $marker = $redis->hgetall($key);
    $markers[] = $marker;
}

// Exiba os detalhes dos marcadores

 foreach ($markers as $marker) {
     if($marker['name'] != '<name>'){
         echo 'Nome: '    . $marker['name']."<br>";
         echo 'Endereço: ' . $marker['address']."<br>";
         echo 'Lat: '     . $marker['lat']."<br>";
         echo 'Lng: '     . $marker['lng']."<br>";
         echo 'Tipo: '    . $marker['type']."<br><br>";
     }
 }

?>