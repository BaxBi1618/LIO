<header>
    <a href="/dashboard">
        <h1>LIO</h1>
        <h4>
            <span class="first-letter">L</span>ife
            <span class="first-letter">I</span>n
            <span class="first-letter">O</span>rder
        </h4>
    </a>

    <section>
        <?php

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $current_website = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $hidden_websties = ['/register', '/login'];
        if (isset($_SESSION['user_id'])) {
            echo "<a href='/setting'><img src='/images/user.png'></a>";
            echo "<a href='/logout' class='account_buttons'>Wyloguj</a>";
        } elseif (!in_array($current_website, $hidden_websties)) {
            echo '<a href="/login" class="account_buttons">Zaloguj</a>';
            echo '<a href="/register" class="account_buttons">Zarejestruj</a>';
        }
        ?>
    </section>
</header>
