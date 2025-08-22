<?php
namespace App;

class ErrorHandler
{
    private array $errors = [];

    public function addError(string $key, string $message): void
    {
        $this->errors[$key] = $message;
    }

    public function getError(string $key): ?string
    {
        return $this->errors[$key] ?? null;
    }

    public function hasError(string $key): bool
    {
        return isset($this->errors[$key]);
    }

    public function getAll(): array
    {
        return $this->errors;
    }

    public function clear(): void
    {
        $this->errors = [];
    }

    public function saveToSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['errors'] = $this->errors;
    }

    public static function fromSession(): self
    {
        $handler = new self();
        if (isset($_SESSION['errors']) && is_array($_SESSION['errors'])) {
            $handler->errors = $_SESSION['errors'];
        }
        unset($_SESSION['errors']);
        return $handler;
    }
}
