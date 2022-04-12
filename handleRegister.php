<?php

require_once 'classes/RegistrationStatus.php';

function handleRegister(?string $username = null, ?string $password = null): RegistrationStatus
{
    if (!isset($username) || !isset($password)) {
        return new RegistrationStatus('Brak wymaganych pól');
    }

    $getUserStatement = $GLOBALS['getUserByNameStmt'];
    $getUserStatement->bind_param('s', $username);
    $getUserStatement->execute();

    $res = $getUserStatement->get_result();

    if ($res->num_rows !== 0)
        return new RegistrationStatus('Użytkownik o tej nazwie już istnieje');
    if(strlen($username) === 0)
        return new RegistrationStatus('Nie podano nazwy użytkownika');
    if(!preg_match('/^[a-zA-Z0-9]{1,30}$/', $username))
        return new RegistrationStatus('Nazwa użytkownika jest niepoprawna');
    if(strlen($username) > 30)
        return new RegistrationStatus('Nazwa użytkownika jest zbyt długa');
    if(strlen($password) > 255)
        return new RegistrationStatus('Hasło jest zbyt długie');

    $registerStatement = $GLOBALS['registerStmt'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $registerStatement->bind_param('ss', $username, $hashedPassword);
    $registerStatement->execute();

    return new RegistrationStatus();
}