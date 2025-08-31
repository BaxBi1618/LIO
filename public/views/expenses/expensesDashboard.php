<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expensions</title>
    <link rel="stylesheet" href="/assets/styles/expenses.css">
</head>
<body>
    <?php
        include_once render_view(APP_PATH, "components/header.php");
    ?>
    <main>
        <div id="managmentListDiv">
            <div id="buttonDiv">
                <a href="" id="revenueButton">Przychody</a>
                <a href="" id="expensesButton">Wydatki</a>
            </div>
        </div>
        <section id="centerDiv">
            <div id="monthNameDiv"></div>
            <div id="graphDiv"></div>
        </section>
        <div id="savingsDiv">

        </div>
    </main>
</body>
</html>l