<?php
define('BASE_PATH', dirname(__DIR__));
define('VIEW_PATH', BASE_PATH . '/public/views');
define('STYLE_PATH', BASE_PATH . '/asset/styles');
define('APP_PATH', BASE_PATH . '/app');
define('CONFIG_PATH', BASE_PATH . '/config');

function render_view($Static_path, string $path)
{
    $contentPath = $Static_path . '/' . $path;
    return $contentPath;
}

//* autoloader
require_once __DIR__ . '/../vendor/autoload.php';
?>
