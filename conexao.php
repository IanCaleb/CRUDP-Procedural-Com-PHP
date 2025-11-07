<?php 

$hostname = "localhost"; 
$usuario = "root";
$senha = "";
$bancoDeDados = "conexao_teste";

//conexão
$mysqli = new mysqli($hostname, $usuario, $senha, $bancoDeDados);

//se der erro, printa qual foi o erro
if($mysqli->connect_errno){
    echo "falha ao conectar: (" .$mysqli->connect_errno . ")" . $mysqli->connect_error;
}

?>