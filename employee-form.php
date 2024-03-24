<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="employee-form-page">

<?php include 'menu.html';
$message = $_GET['message'] ?? null;
$id = $_GET['id'] ?? null;
$firstName = $_GET['first_name'] ?? null;
$lastName = $_GET['last_name'] ?? null;
?>

<div class="container">
    <?php if ($message): ?>
        <div class="message-error" id="error-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="title">Add Employee</div>
    <div class="form-container">
        <form method="post" action="functions.php">
            <div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="firstName">First name:</label>
                <input type="text" name="firstName" id="firstName" placeholder="1-21 characters"
                    <?php if ($firstName): ?>
                        value="<?php echo $firstName; ?>"
                    <?php endif; ?>>
            </div>
            <br>
            <div>
                <label for="lastName">Last name:</label>
                <input type="text" name="lastName" id="lastName" placeholder="2-22 characters"
                    <?php if ($lastName): ?>
                        value="<?php echo $lastName; ?>"
                    <?php endif; ?>>
            </div>
            <br>
            <div>
                <label for="picture">Picture:</label>
                <button id="picture">Choose File</button>
                No file chosen
            </div>
            <br>
            <div>
                <button type="submit" name="submitButton"
                        value="employee">Save
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.html' ?>
</body>

</html>