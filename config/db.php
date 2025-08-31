<?php
function db_connect()
{
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "lio";

    $conn = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        die("Błąd połączenia: " . mysqli_connect_error());
    }

    return $conn;
}
?>
