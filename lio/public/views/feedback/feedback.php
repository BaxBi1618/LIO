<?php
//todo zrobić zapobieganie xss
use App\Auth;
use App\ErrorHandler;

$Auth = new Auth();
$Auth->redirectIfNotLogged();

$Error= ErrorHandler::fromSession();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset=UTF-8>
    <title>Feedback</title>
    <link rel="stylesheet" href="/assets/styles/feedback.css">
</head>
<body>
    <?php include_once render_view(APP_PATH, 'components/header.php'); ?>
    <main>
        <form action="feedback" method="POST">
            <div class="labelDiv">
                <label for="category">Wybierz kategorię:</label>
                <?php 
                if ($msg = $Error->getError("categoryError")) {
                    echo "<span class='error'>$msg</span>";
                }
                ?>
            </div>
            <select id="category" name="category">
                <option value="1">Błędy</option>
                <option value="2">Propozycje</option>
                <option value="3">Opinie</option>
            </select>
            <div class="labelDiv">
                <label for="comment">Komentarz:</label>
                <?php 
                if ($msg = $Error->getError("commentError")) {
                    echo "<span class='error'>$msg</span>";
                }
                ?>
            </div>
            <textarea name="comment" id="comment"></textarea>
            <button type="submit">Wyślij</button>
            <?php 
                if ($msg = $Error->getError("dbError")) {
                    echo "<span class='error'>$msg</span>";
                }
            ?>
        </form>
    </main>
</body>
</html>

