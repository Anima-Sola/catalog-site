<?php

session_start();
//$_SESSION['who'] = 'user';
$_SESSION['recordsPerPage'] = 20;
ini_set('display_errors', 1);

require_once 'application/bootstrap.php';
require_once '../common/pagination.php';

(new Bootstrap([
    'core',
    'controllers',
    'models'
]))->start();
header("Content-Type: text/html; charset=utf-8");
Route::start();