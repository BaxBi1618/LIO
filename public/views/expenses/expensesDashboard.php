<?php
use App\Auth;

$Auth = new Auth();
$Auth->redirectIfNotLogged();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses</title>
    <link rel="stylesheet" href="/assets/styles/subpages/expenses.css">
    <script src="/assets/js/expenses.js"></script>
</head>
<body>
    <?php
        include_once render_view(APP_PATH, "components/header.php");
    ?>
    <main>
        <section id="leftDiv">
            <div id="monthNameDiv"></div>
            <div id="buttonDiv">
                <a href="" id="revenueButton">Przychody</a>
                <a href="" id="expensesButton">Wydatki</a>
            </div>
        </section>
        <div id="graphDiv"></div>
        <div id="savingsDiv"></div>
        <div id="incomeDiv">
            <h2>Przychody</h2>
            <?php 
            foreach ($expenses as $expense) {
                if ($expense['type'] === 'income') {
                    ?>
                    <div>
                        <span class="category"><?= $expense['category_name'] ?></span>
                        <span class="amount"><?= $expense['amount'] ?> zł</span>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </main>
</body>
</html>
