<?php
//TODO zrobić zapobieganie xss

use App\Auth;
use App\ErrorHandler;

$Auth = new Auth();
$Auth->redirectIfLogged();

$Error= ErrorHandler::fromSession();

//TODO poprawić obsługę błędów

?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="/assets/styles/subpages/login.css" />
    </head>
    <body>
        <?php include_once render_view(APP_PATH, 'components/header.php'); ?>
        <main>
            <form action="/login" method="POST">
                <label for="log">Login</label><br />
                <input type="text" id="log" name="login" autocomplete="off" /><br />
                <label for="pas">Hasło</label><br />
                <input type="password" id="pas" name="password" />
                <button type="submit">Zaloguj</button>
                <?php if($Error->hasError("dateError")):?>
                    <div id="errorDiv">
                        <?= $Error->getError("dateError")?>
                    </div>
                <?php endif; ?>
            </form>
        </main>
    </body>
</html>
