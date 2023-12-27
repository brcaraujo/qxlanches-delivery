<?php
session_start();
header("Access-Control-Allow-Origin: *");

$valor = file_get_contents('php://input');

$valores = json_decode($valor);

// var_dump($valores->sum);

echo(round($_SESSION["valor-total"]= $valores->sum, 2));



