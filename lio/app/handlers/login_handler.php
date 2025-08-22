<?php
require_once render_view(CONFIG_PATH, "db.php");


use App\ErrorHandler;
use App\Validator;

$conn = db_connect();

$Error = new ErrorHandler();

$Validator = new Validator($Error);

//* Czyścimy poprzednie błędy
$Error->clear();

//* Pobieramy dane z formularza
$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';

//* Walidujemy dane
$Validator
    ->required($login,'dateError','Brak danych logowania')
    ->required($password,'dateError','Brak danych logowania');

if (!empty($Error->getAll())) {
    $Error->saveToSession();
    header("Location: /login");
    exit;
}

$stmt = $conn->prepare("SELECT id, password FROM users WHERE login = ?");
$stmt->bind_param("s", $login);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Sprawdzamy hasło (UWAGA: password_hash i password_verify w bazie!)
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        header("Location: /dashboard");
        exit;
    } else {
        $Error->addError("logsError", "Błędne dane logowania ha");
    }
} else {
    $Error->addError("logsError", "Błędne dane logowania lo");
}

//* jeżeli login/hasło są nieprawidłowe
$Error->saveToSession();
header("Location: /login");
exit;
//TODO: DODAĆ WALIDACJĘ DANYCH I BEZPIECZEŃSTWO DANYCH