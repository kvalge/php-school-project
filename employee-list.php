<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee list</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="employee-list-page">

<?php

include 'menu.html';

require_once 'functions.php';

$employees = getEmployees();

$message = $_GET['message'] ?? null;

?>

<div class="container">

    <?php if ($message): ?>
        <div class="message-success" id="message-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="title">Employees</div>
    <?php foreach ($employees as $employee) : ?>
        <div class="list-container">
            <div class="info-text">
                <div>
                    <span data-employee-id="<?php echo $employee->id ?>"><?php print $employee->firstName . ' ' . $employee->lastName; ?></span>
                </div>
                <div>
                    <?php echo $employee->position ?>
                </div>
            </div>
            <div class="info-update">
                <div class="edit">
                    <a id="employee-edit-link-<?php echo $employee->id ?>"
                       href="employee-form.php?id=<?php echo $employee->id; ?>">Edit</a>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
</div>

<div class="footer">
    <?php include 'footer.html' ?>
</div>

</body>

</html>