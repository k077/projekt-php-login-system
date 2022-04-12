<?php
function connectToDB(): mysqli
{
    return new mysqli('localhost', 'root', '', 'wj_projekt');
}