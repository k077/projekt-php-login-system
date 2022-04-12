<?php

require_once '../handleLogIn.php';
require_once '../handleGetSessionStatus.php';
require_once '../classes/SessionStatus.php';

require '../init.php';

[$userName, $pass] = [$_POST['log-in-username'] ?? null, $_POST['log-in-password'] ?? null];
$res = handleLogIn($userName, $pass);

$_SESSION['status']->logInStatus = $res;

echo handleGetSessionStatus();
