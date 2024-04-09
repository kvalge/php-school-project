DROP TABLE IF EXISTS employee;
DROP TABLE IF EXISTS task;

CREATE TABLE employee
(
    id         INTEGER PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255),
    last_name  VARCHAR(255),
    position   VARCHAR(255)
);

CREATE TABLE task
(
    id          INTEGER PRIMARY KEY AUTO_INCREMENT,
    employee_id INTEGER NULL,
    description VARCHAR(255),
    estimate    INTEGER,
    state       VARCHAR(255)
);