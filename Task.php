<?php

class Task {

    public ?string $id = null;
    public ?int $employeeId;
    public string $description;
    public string $estimate;
    public ?string $state;

    public function __construct(?string $id, ?int $employeeId, string $description, string $estimate, ?string $state) {
        $this->id = $id;
        $this->employeeId = $employeeId;
        $this->description = $description;
        $this->estimate = $estimate;
        $this->state = $state;
    }
}
