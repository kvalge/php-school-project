<?php

require_once 'functions.php';

$input = $_POST['temperature'] ?? null;

if ($input === null || $input === '') {
    $message = 'Insert temperature';
} elseif (!is_numeric($input)) {
    $message = 'Temperature must be an integer';
} else {
    $input_temp = floatval($input);
    $result = c2f($input_temp);
    $message = sprintf("%d degrees in Celsius is %d degrees in Fahrenheit", $input_temp, $result);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Celsius to Fahrenheit</title>
</head>
<body>
<nav>
    <a href="index.html" id="c2f">Celsius to Fahrenheit</a> |
    <a href="f2c.html" id="f2c">Fahrenheit to Celsius</a>
</nav>
<main>
    <h3>Celsius to Fahrenheit</h3>
    <em><?= $message ?></em>
</main>
</body>
</html>
