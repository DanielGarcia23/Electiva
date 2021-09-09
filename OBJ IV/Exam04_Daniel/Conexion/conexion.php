<?php

$servidor = "mysql:dbname=exam04_daniel;host=127.0.0.1";
$usuario = "root";
$password = "";

try{
    $pdo = new PDO ($servidor, $usuario, $password);
    

}catch(PDOException $e){

    echo "Conexion Fallida". $e ->getMessage();

}
?>