<?php

//database credentials
define('DB_HOST', 'db');
define('DB_NAME', 'postgres');
define('DB_PORT', '5432');
define('DB_USER', 'postgres');
define('DB_PASS', 'password');

$db = new PDO('pgsql:dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

require_once 'functions.php';
