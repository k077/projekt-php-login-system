<?php

require_once 'UserData.php';
require_once 'LogInStatus.php';
require_once 'RegistrationStatus.php';

class SessionStatus
{
    public ?UserData $user = null;
    public ?LogInStatus $logInStatus = null;
    public ?RegistrationStatus $registrationStatus = null;

}