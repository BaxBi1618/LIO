<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/assets/styles/subpages/index.css" />
    <title>Dashboard</title>
</head>
<body>
<?php
//todo: zrobić autoloader class z composer i psr-4
include_once render_view(APP_PATH, "components/header.php");

use App\Auth;

$Auth = new Auth();

if ($Auth->islogged()) {
    include_once render_view(APP_PATH, "components/logged_user.php");
} else {
    include_once render_view(APP_PATH, "components/no_logged_user.php");
}
?>
</body>
</html>
