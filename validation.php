<?php

function validateEmployee(Employee $employee): ?string {
    if (strlen(trim($employee->firstName)) < 1 || strlen(trim($employee->firstName)) > 21) {
        return 'Length of the first name should be 1 - 21!';
    }
    elseif (strlen(trim($employee->lastName)) < 2 || strlen(trim($employee->lastName)) > 22){
        return 'Length of the last name should be 2 - 22!';
    }
    return null;
}

function validateTaskDescription(string $description): ?string {
    if (strlen(trim($description)) >= 5 && strlen(trim($description)) <= 40) {
        return null;
    }
    return 'Length of the description should be 5 - 40!';
}
