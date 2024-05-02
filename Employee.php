<?php

class Employee {

    public ?string $id = null;
    public string $firstName;
    public string $lastName;
    public ?string $position;

    public function __construct(?string $id, string $firstName,  string $lastName, ?string $position) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->position = $position;
    }
}