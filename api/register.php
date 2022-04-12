<?php
require '../init.php';
require_once '../handleRegister.php';
require_once '../classes/RegistrationStatus.php';
require_once '../classes/SessionStatus.php';

[$userName, $pass] = [$_POST['register-username'] ?? null, $_POST['register-password'] ?? null];
$res = handleRegister($userName, $pass);
$_SESSION['status']->registrationStatus = $res;
echo json_encode($_SESSION['status']);
