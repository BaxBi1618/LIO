<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/styles/settings.css">
    <title>Settings</title>
</head>
<body>
    <?php
    include_once render_view(APP_PATH, 'components/header.php');

    use App\User;
    use App\Auth;
    $Error;
    $Auth = new Auth();

    $Auth->redirectIfNotLogged();

    ?>

    <main>
        <h1>Ustawienia użytkownika</h1>
        <hr>

        <form action="/setting" method="POST">
            <section>
                <?php

                $user = new User($_SESSION['user_id']);
                $date = $user->get_date();

                $inputs_list = [
                    "name" => ["Imię", "text", $date['name']],
                    "surname" => ["Nazwisko", "text", $date['surname']],
                    "date_of_birth" => ["Data urodzenia", "date", $date['date_of_birth']],
                    "phone_number" => ["Numer telefonu", "tel", $date['phone_number']],
                    "email" => ["Email", "email", $date['email']],
                    "login" => ["Login", "text", $date['login']]
                ];

                require_once render_view(APP_PATH, 'functions/generate_inputs.php');
                echo generate_input($inputs_list,$Error);
                ?>
            </section>
            <button type="submit">Zapisz</button>
        </form>
    </main>
</body>
</html>
