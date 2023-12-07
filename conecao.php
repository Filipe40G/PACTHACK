<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'Filipe40G#');
define('DB_DATABASE', 'Pact');


$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}


?>