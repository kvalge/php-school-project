<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="task-form-page">

<?php include 'menu.html' ?>

<?php
$message = $_GET['message'] ?? null;
$id = $_GET['id'] ?? null;
$description = $_GET['description'] ?? null;
?>

<div class="container">
    <?php if ($message): ?>
        <div class="message-error" id="error-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="title">Add Task</div>
    <div class="form-container">
        <form method="POST" action="functions.php">
            <br>
            <div class="textarea">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3"
                          cols="50"><?php if ($description): ?>
                        <?php echo $description; ?>
                    <?php endif; ?></textarea>
            </div>
            <br>
            <div>
                <label>Estimate </label>
                <input type="radio" name="estimate" value="1"> 1
                <input type="radio" name="estimate" value="2"> 2
                <input type="radio" name="estimate" value="3"> 3
                <input type="radio" name="estimate" value="4"> 4
                <input type="radio" name="estimate" value="5"> 5
            </div>
            <br>
            <div>
                <button type="submit" name="submitButton"
                        value="task">Save
                </button>
            </div>
            <br>
        </form>
    </div>
</div>

<?php include 'footer.html' ?>

</body>

</html>