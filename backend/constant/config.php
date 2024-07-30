<?php

$envFilePath = __DIR__ . '/../.env';


if (!file_exists($envFilePath)) {
    throw new Exception("The .env file does not exist.");
}

$lines = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) {
        continue;
    }

    list($key, $value) = explode('=', $line, 2);
    $key = trim($key);
    $value = trim($value);

    define(strtoupper($key), $value);
}