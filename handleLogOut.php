<?php
require_once 'classes/SessionStatus.php';
function handleLogOut()
{
    session_destroy();
    require 'initSession.php';
}