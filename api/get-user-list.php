<?php

require '../init.php';

if(!$_SESSION['status']->user) {
    echo json_encode([], JSON_UNESCAPED_UNICODE);
    return;
}

$getUserListStatement = $GLOBALS['getUserListStmt'];
$getUserListStatement->execute();

$res = $getUserListStatement->get_result();

$list = [];
while ($row = $res->fetch_assoc()) {
    $list[] = $row;
}

echo json_encode($list, JSON_UNESCAPED_UNICODE);