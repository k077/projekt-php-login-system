<?php
require_once 'classes/LogInStatus.php';
require_once 'classes/UserData.php';
require_once 'classes/SessionStatus.php';
require_once 'handleLogOut.php';

function handleLogIn(?string $username = null, ?string $password = null): LogInStatus
{
    handleLogOut();

    if (!isset($username) || !isset($password)) {
        return new LogInStatus('Brak wymaganych pól');
    }

    $getUserStatement = $GLOBALS['getUserByNameStmt'];

    $getUserStatement->bind_param('s', $username);
    $getUserStatement->execute();

    $res = $getUserStatement->get_result();

    $wrongUsernameOrPassErrMsg = 'Niepoprawna nazwa użytkownika lub hasło';
    if ($res->num_rows === 0)
        return new LogInStatus($wrongUsernameOrPassErrMsg);

    $logInData = $res->fetch_assoc();

    if (!password_verify($password, $logInData['password']))
        return new LogInStatus($wrongUsernameOrPassErrMsg);
    echo $_SESSION['status']->user;
    $_SESSION['status']->user = new UserData($logInData['id'], $logInData['username']);
    return new LogInStatus();
}