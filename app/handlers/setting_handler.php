<?php
require_once render_view(CONFIG_PATH, "db.php");

session_start();

$conn = db_connect();

$sql = "UPDATE `users` SET 
    `name` = '{$_POST['name']}',
    `surname` = '{$_POST['surname']}',
    `date_of_birth` = '{$_POST['date_of_birth']}',
    `phone_number` = '{$_POST['phone_number']}',
    `email` = '{$_POST['email']}',
    `login` = '{$_POST['login']}'
    WHERE `id` = " . $_SESSION['user_id'];

if (mysqli_query($conn, $sql)) {
    header("Location: /setting");
    exit;
}

//TODO: DODAĆ WALIDACJĘ DANYCH
?>