<?php
function getdb(){
$servername = "127.0.0.1";
$username = "admin";
$password = "admin";
$db = "testedb";

try {
   
    $conn = mysqli_connect($servername, $username, $password, $db);

    }
catch(exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}

?>
