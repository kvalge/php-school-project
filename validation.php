<?php

function validateEmployee(Employee $employee): ?string {
    if (strlen($employee->firstName) < 1 || strlen($employee->firstName) > 21) {
        return 'Length of the first name should be 1 - 21!';
    }
    elseif (strlen($employee->lastName) < 2 || strlen($employee->lastName) > 22){
        return 'Length of the last name should be 2 - 22!';
    }
    return null;
}

function validateTaskDescription(string $description): ?string {
    if (strlen($description) >= 5 && strlen($description) <= 40) {
        return null;
    }
    return 'Length of the description should be 5 - 40!';
}
