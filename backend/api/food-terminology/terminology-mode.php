<?php

function prepareTerminologyData($postData) {

    $terminology = [];

    $terminology['terminology_name'] = validate_input($postData['terminology_name'], '/^[a-zA-Z\s]+$/', 'Food Name can only contain letters and spaces');
    
    $terminology['food_type_id'] = validate_input($postData['food_type_id'], '/^[0-9]+$/', 'Food Type can only contain Numbers');
    
    $terminology['terminology_number'] = validate_input($postData['terminology_number'], '/^[0-9]+$/', 'Terminology Number can only contain Numbers');
    
    return $terminology;
}
