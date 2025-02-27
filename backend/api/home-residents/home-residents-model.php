<?php

function prepareHomeResidentsData($postData) {

    $homeResidents = [];

    $homeResidents['name'] = validate_input($postData['name'], '/^[a-zA-Z\s]+$/', 'Home Residents Name can only contain letters and spaces');
    
    $homeResidents['food_terminology_id'] = validate_input($postData['food_terminology_id'], '/^[0-9]+$/', 'Select Food Terminology');
    
    $homeResidents['food_type_id'] = validate_input($postData['food_type_id'], '/^[0-9]+$/', 'Select Food Terminology');
    
    return $homeResidents;
}
