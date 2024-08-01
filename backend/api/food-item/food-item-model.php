<?php

function prepareFoodItemData($postData) {

    $foodItem = [];

    $foodItem['food_name'] = validate_input($postData['food_name'], '/^[a-zA-Z\s]+$/', 'Food Name can only contain letters and spaces');
    
    $foodItem['food_category_id'] = validate_input($postData['food_category_id'], '/^[0-9]+$/', 'Food Category can only contain Numbers');
    
    $foodItem['food_type_id'] = validate_input($postData['food_type_id'], '/^[0-9]+$/', 'Food Type can only contain Numbers');
    
    $foodItem['food_terminology_id'] = validate_input($postData['food_terminology_id'], '/^[0-9]+$/', 'Food Terminology can only contain Numbers');
    
    return $foodItem;
}

?>