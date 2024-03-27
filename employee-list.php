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

<?php include 'menu.html' ?>

<?php

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
                <?php var_dump($employee[0]) ?>
                <div data-employee-id="<?php $employee[0] ?>">
                    <?php if ($employee[0]) {
                        echo $employee[1] . ' ' . $employee[2];
                    } ?>
                </div>
                <div class="edit">
                    <a id="employee-edit-link-<?php $employee[0] ?>"
                       href="employee-form.php?id=<?php echo $employee[0]; ?>&first_name=<?php echo urlencode($employee[1]); ?>&last_name=<?php echo urlencode($employee[2]); ?>">Edit</a>
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