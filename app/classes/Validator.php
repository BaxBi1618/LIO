<?php
namespace App;

class Validator
{
    private ErrorHandler $errorHandler;

    public function __construct(ErrorHandler $errorHandler)
    {
        $this->errorHandler = $errorHandler;
    }

    public function required($value, string $key, string $fieldName): self
    {
        if (empty(trim((string)$value))) {
            $this->errorHandler->addError($key, $fieldName);
        }
        return $this;
    }

    public function inArray($value, array $allowed, string $key, string $fieldName): self
    {
        if (!in_array($value, $allowed)) {
            $this->errorHandler->addError($key, $fieldName);
        }
        return $this;
    }

    public function uniqueLogin(string $login, string $key, string $fieldName, \mysqli $conn): self
    {
    $stmt = $conn->prepare("SELECT id FROM users WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $this->errorHandler->addError($key, $fieldName);
    }

    $stmt->close();
    return $this;
    }

    public function validEmail(string $email, string $key, string $fieldName): self
    {
    if ($email === '') {
        // puste pole traktujemy jako poprawne, więc zwracamy od razu
        return $this;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->errorHandler->addError($key, $fieldName);
    }

    return $this;
    }

    public function exactLength(string $key, string $value, int $exact): self
    {
        if (mb_strlen($value) !== $exact) {
            $this->errorHandler->addError($key, "Pole musi mieć dokładnie $exact znaków.");
        }

        return $this;
    }

    public function validPhone(string $phone ,string $key, string $fieldName): self
    {
    if ($phone === '') {
        // puste pole jest OK
        return $this;
    }

    // Sprawdź czy dokładnie 9 znaków
    if (!$this->exactLength($key, $phone, 9)) {
        $this->errorHandler->addError($key, $fieldName);
    }

    // Sprawdź czy tylko cyfry
    if (!preg_match('/^\d{9}$/', $phone)) {
        $this->errorHandler->addError($key, $fieldName);
    }

    return $this;
    }

    public function validDate(string $date, string $key, string $fieldName): self
{
    $date = trim($date);

    // sprawdzamy poprawny format Y-m-d (HTML type="date")
    $d = \DateTime::createFromFormat('Y-m-d', $date);

    if (!$d || $d->format('Y-m-d') !== $date) {
        $this->errorHandler->addError($key, $fieldName);
        return $this;
    }

    // obliczamy różnicę w latach
    $today = new \DateTime();
    $age = $today->diff($d)->y;

    if ($age < 18) {
        $this->errorHandler->addError($key, $fieldName);
    }

    return $this;
}

}
