<?php

require_once 'classes/SessionStatus.php';

function handleGetSessionStatus(): string {
    return json_encode($_SESSION['status'], JSON_UNESCAPED_UNICODE);
}