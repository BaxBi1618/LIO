<?php
require_once render_view(CONFIG_PATH, 'db.php');

use App\ErrorHandler;
use App\Validator;

$Error = new ErrorHandler();
$Validator = new Validator($Error);

$Error->clear();

$conn = db_connect();

// * pobieranie danych z formularza 

$login        = $_POST['login'] ?? '';
$password     = $_POST['password'] ?? '';
$name         = $_POST['name'] ?? '';
$surname     = $_POST['surname'] ?? '';
$date_of_birth= $_POST['date_of_birth'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';
$email        = $_POST['email'] ?? '';
$roleId = 1;

// * validacja danych
$Validator
    ->required($login, 'logError', 'Login nie podany')
    ->required($password, 'pasError', 'Hasło nie podane')
    ->uniqueLogin($login, 'logError', 'Podany login już istnieje', $conn)
    ->validEmail($email, 'emailError', 'Email jest nieprawidłowy')
    ->validPhone($phone_number, 'phoneError', 'Numer jest nieprawidłowy')
    ->validDate($date_of_birth, 'dateError', 'Zła data urodzenia');
    
if (!empty($Error->getAll())) {
    $Error->saveToSession();
    header('Location: /register');
    exit;
}

// * Hashowanie hasła
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// * Wstawianie nowego użytkownika
$stmt = $conn->prepare("INSERT INTO `users` 
    (`name`, `surname`, `date_of_birth`, `phone_number`, `email`, `login`, `password`, `role_id`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssi", $name, $surname, $date_of_birth, $phone_number, $email, $login, $hashedPassword, $roleId);

if (!$stmt->execute()) {
    $Error->addError("dbError", "Błąd zapisu do bazy danych.");
    $Error->saveToSession();
    header("Location: /register");
    exit;
}

header("Location: /login");
exit;
