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

$message = $_GET['message'] ?? null;

?>

<div class="container">
    <?php if ($message): ?>
        <div class="message-success" id="message-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="title">Employees</div>
    <?php foreach (getEmployees() as $key => $employee) : ?>
        <div class="list-container">
            <div>
                <div data-employee-id="<?php $employee[0] ?>">
                    <?php print $employee[1] . ' ' . $employee[2]; ?>
                </div>
                <div class="edit">
                    <a id="employee-edit-link-<?php $employee[0] ?>"
                       href="employee-form.php?id=<?php print $employee[0]; ?>">Edit</a>
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