<?php

function validate_input($input, $pattern, $errorMessage) {
    if (!preg_match($pattern, $input)) {
        echo Response::jsonResponse(false, $errorMessage);
        exit();
    }
    return $input;
}