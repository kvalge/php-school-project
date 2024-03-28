<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="employee-form-page">

<?php

include 'menu.html';

require_once 'functions.php';

?>

<?php

$message = $_GET['message'] ?? null;
$id = $_GET['id'] ?? null;
$firstName = isset($_GET['first_name']) ? $_GET['first_name'] : null;
$lastName = isset($_GET['last_name']) ? $_GET['last_name'] : null;

if ($id) {
    foreach (getEmployees() as $key => $employee) {
        if ($employee[0] == $id) {
            $firstName = $employee[1];
            $lastName = $employee[2];
        }
    }
}

?>

<div class="container">

    <?php if ($message): ?>
        <div class="message-error" id="error-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="title">Add Employee</div>

    <div class="form-container">
        <form method="post" action="functions.php">
            <div>
                <label for="firstName">First name:</label>
                <input type="text" name="firstName" id="firstName" placeholder="1-21 characters"
                       value="<?php print $firstName; ?>">
            </div>
            <br>
            <div>
                <label for="lastName">Last name:</label>
                <input type="text" name="lastName" id="lastName" placeholder="2-22 characters"
                       value="<?php print $lastName; ?>">
            </div>
            <br>
            <div>
                <label for="picture">Picture:</label>
                <button id="picture">Choose File</button>
                No file chosen
            </div>
            <br>

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" name="submitButton" value="employee">Save</button>
        </form>
        <form method="post" action="functions.php">
            <?php if ($id): ?>
                <input type="hidden" name="employeeId" value="<?php echo $id; ?>">
                <button type="submit" name="deleteButton">Delete</button>
            <?php endif; ?>
        </form>
    </div>

</div>

<div class="footer">
    <?php include 'footer.html' ?>
</div>
</body>

</html>