<?php
require '../init.php';
require_once '../handleLogOut.php';
require_once '../handleGetSessionStatus.php';

handleLogOut();
echo handleGetSessionStatus();
