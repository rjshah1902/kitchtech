<?php

function prepareFoodItemData($postData) {

    $foodItem = [];

    $foodItem['food_name'] = validate_input($postData['food_name'], '/^[a-zA-Z\s]+$/', 'Food Name can only contain letters and spaces');
    
    $foodItem['food_category_id'] = validate_input($postData['food_category_id'], '/^[0-9]+$/', 'Select Food Category');
    
    $foodItem['food_terminology_id'] = validate_input($postData['food_terminology_id'], '/^[0-9]+$/', 'Select Food Terminology');
    
    $foodItem['food_type_id'] = validate_input($postData['food_type_id'], '/^[0-9]+$/', 'Select  Food Type');
    
    return $foodItem;
}

?>