<?php
require_once render_view(CONFIG_PATH, "db.php");

use App\ErrorHandler;
use App\Validator;

$conn = db_connect();

$Error = new ErrorHandler();
$validator = new Validator($Error);

//* Czyścimy poprzednie błędy
$Error->clear();

//* Pobieramy dane z formularza
$comment = $_POST['comment'] ?? '';
$category = $_POST['category'] ?? '';
$user_id = $_SESSION['user_id'];

//* Walidujemy dane
$validator
    ->required($comment, 'commentError', 'Brak komentarza')
    ->inArray($category, [1, 2, 3], 'categoryError', 'Nieznana kategoria');

//* Jeśli nie ma błędów - wykonujemy zapytanie
if (empty($Error->getAll())) {
    $stmt = $conn->prepare("INSERT INTO `feedback`(`user_id`,`category_id`, `comment`) VALUES (?, ?, ?)");
    $stmt->bind_param("iis",$user_id,$category,$comment);

    if (!$stmt->execute()) {
        $Error->addError("dbError", "Błąd zapisu do bazy danych.");
        header("Location: /feedback");
        exit;
    }

    header("Location: /feedback");
    exit;
}

//* W przypadku błędów lub nieudanego zapisu
$Error->saveToSession();
header("Location: /feedback");
exit;
