<?php
//todo zrobić zapobieganie xss i obsługę errorów

use App\Auth;
use App\ErrorHandler;

$Auth = new Auth();
$Auth->redirectIfLogged();

$Error= ErrorHandler::fromSession();

?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8" />
        <title>Rejestracja</title>
        <link rel="stylesheet" href="/assets/styles/subpages/register.css" />
    </head>
    <body>
        <?php include_once render_view(APP_PATH, 'components/header.php'); ?>
        <main>
            <form action="/register" method="POST">
                <section>
                    <?php
                  $inputs_list = [
                        "name" => ["Imie", "text", "", ""],
                        "surname" => ["Nazwisko", "text", "", ""],
                        "date_of_birth" => ["Data urodzenia", "date", "", "dateError"],
                        "phone_number" => ["Numer telefonu", "tel", "", "phoneError"],
                        "email" => ["Email", "text", "", "emailError"],
                        "login" => ["Login", "text", "", "logError"],
                        "password" => ["Hasło", "password", "", "pasError"]
                    ];

                    require_once render_view(APP_PATH, 'functions/generate_inputs.php');
                    echo generate_input($inputs_list,$Error);
                    ?>
                </section>
                <button type="submit">Zarejestruj</button>
            </form>
        </main>
    </body>
</html>
