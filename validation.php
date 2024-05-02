<?php

function validateFirstName(string $firstName): ?string {
    if (strlen($firstName) >= 1 && strlen($firstName) <= 21) {
        return null;
    }
    return 'Length of the first name should be 1 - 21!';
}

function validateLastName(string $lastName): ?string {
    if (strlen($lastName) >= 2 && strlen($lastName) <= 22) {
        return null;
    }
    return 'Length of the last name should be 2 - 22!';
}

function validateTaskDescription(string $description): ?string {
    if (strlen($description) >= 5 && strlen($description) <= 40) {
        return null;
    }
    return 'Length of the description should be 5 - 40!';
}
