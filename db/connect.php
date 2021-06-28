<?php

$mysqli = new mysqli('localhost', 'root', '', 'contacts');

if ($mysqli -> connect_errno) {
    echo "Грешка при свързване с MySQL: " . $mysqli -> connect_error;
    exit();
}
