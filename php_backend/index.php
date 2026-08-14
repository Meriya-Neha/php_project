<?php 


ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/src/config/db.php';
require_once __DIR__ . '/src/cors/cors.php';
require_once __DIR__ . '/src/utils/errorhandler.php';
require_once __DIR__ . '/src/utils/response.php';
require_once __DIR__ . '/src/utils/exception.php';

set_exception_handler(fn(Throwable $err) => ErrorHandler::handle($err));

set_error_handler(function ($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) return false;
    throw new ErrorException($message, 0, $severity, $file, $line);
});

$router = require_once __DIR__ . '/src/routes/userroutes.php';
$router->resolve();

?>