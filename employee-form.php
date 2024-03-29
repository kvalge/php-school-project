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

$id = $_GET['id'] ?? null;
$firstName = "";
$lastName = "";

if ($id) {
    $firstName = getEmployeeById($id)[1];
    $lastName = getEmployeeById($id)[2];
}

?>

<div class="container">

    <?php if (isset($message)): ?>
        <div class="message-error" id="error-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="title">Add Employee</div>

    <div class="form-container">
        <form method="post" action="functions.php">
            <div>
                <label for="firstName">First name:</label>
                <input type="text" name="firstName" id="firstName" placeholder="1-21 characters"
                       value="<?php echo isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : trim($firstName); ?>">
            </div>
            <br>
            <div>
                <label for="lastName">Last name:</label>
                <input type="text" name="lastName" id="lastName" placeholder="2-22 characters"
                       value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : trim($lastName); ?>">
            </div>
            <br>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="submitted" value="true">
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