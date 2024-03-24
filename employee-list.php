<?php
require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee list</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="employee-list-page">

<?php include 'menu.html';

$message = $_GET['message'] ?? null;
?>

<div class="container">
    <?php if ($message): ?>
        <div class="message-success" id="message-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="title">Employees</div>
    <?php foreach (getEmployees() as $key => $employee) : ?>
        <div class="list-container">
            <div data-employee-id="<?php $employee[0] ?>">
                image
                <?php echo $employee[1]; ?>
                <?php echo $employee[2]; ?><br>
                Position
                <div class="edit">
                    <a id="employee-edit-link-<?php echo $employee[0]; ?>" href="employee-form.php?id=<?php echo $employee[0]; ?>&first_name=<?php echo $employee[1]; ?>&last_name=<?php echo $employee[2]; ?>">Edit</a>
                </div>
                <form method="post" action="functions.php">
                    <input type="hidden" name="employeeId" value="<?php echo $employee[0]; ?>">
                    <button type="submit" name="deleteButton" value="<?php echo $employee[0]; ?>">Delete
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'footer.html' ?>

</body>

</html>