<?php

class EmployeeTask {

    public ?string $employeeId = null;
    public ?int $taskCount = null;

    public function __construct(?string $employeeId, ?int $taskCount) {
        $this->employeeId = $employeeId;
        $this->taskCount = $taskCount;
    }
}
