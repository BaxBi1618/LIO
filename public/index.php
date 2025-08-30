<?php
session_start();

require_once __DIR__ . '/../config/bootstrap.php';

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($request === '/' || $request === '') {
    // Domyślnie przekieruj na dashboard
    header("Location: /dashboard");
    exit;
}

switch($request){
    case '/login':
        if ($method === 'GET') {
            require_once __DIR__ . '/views/auth/login.php';
        } elseif ($method === 'POST') {
            require_once __DIR__ . '/../app/handlers/login_handler.php';
        } else {
            http_response_code(405);
            echo "Metoda HTTP niedozwolona";
        }
        break;


    case '/register':
        if ($method === 'GET'){
            require_once __DIR__ . '/views/auth/register.php';
        }elseif ($method === 'POST'){
            require_once __DIR__ . '/../app/handlers/register_handler.php';
        }else {
            http_response_code(405);
            echo "Metoda HTTP niedozwolona";
        }
        break;
    
    case '/logout':
        require_once __DIR__ . '/../app/functions/logout.php';
        break;

    case '/dashboard':
        require_once __DIR__ . '/views/dashboard/dashboard.php';
        break;

    
    case '/setting':
        if($method === 'GET'){
            require_once __DIR__ . '/views/user/user_settings.php';
        }elseif($method === 'POST'){
            require_once __DIR__ . '/../app/handlers/setting_handler.php';
        }else {
            http_response_code(405);
            echo "Metoda HTTP niedozwolona";
        }
        break;

    
    case '/feedback':
        if($method === 'GET'){
            require_once __DIR__ . '/views/feedback/feedback.php';
        }elseif($method === 'POST'){
            require_once __DIR__ . '/../app/handlers/feedback_handler.php';
        }else {
            http_response_code(405);
            echo "Metoda HTTP niedozwolona";
        }
        break;

    case '/expenses':
        require_once __DIR__ . '/views/expenses/expensesDashboard.php';
        break;

    default:
    http_response_code(404);
    echo "404 - Strona nie znaleziona";
    break;
}