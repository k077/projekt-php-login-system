<?php
require_once 'classes/SessionStatus.php';

@session_start();

if (!isset($_SESSION['status'])) {
    $_SESSION['status'] = new SessionStatus();
}