<?php
require_once 'databaseConnection.php';
require 'initSession.php';

{
    if (isset($GLOBALS['initialized']) && $GLOBALS['initialized'])
        return;

    $conn = $GLOBALS['dBConnection'] = connectToDB();

    $GLOBALS['getUserByNameStmt'] = $conn->prepare(
        "SELECT id, username, password FROM user WHERE username = ?"
    );

    $GLOBALS['getUserByIdStmt'] = $conn->prepare(
        "SELECT id, username, password FROM user WHERE id = ?"
    );

    $GLOBALS['registerStmt'] = $conn->prepare(
        "INSERT INTO user (username, password) VALUES (?, ?)"
    );

    $GLOBALS['getUserListStmt'] = $conn->prepare(
        "SELECT id, username FROM user"
    );

    $GLOBALS['initialized'] = true;
}