<?php

require_once 'connection.php';

$conn = getConnection();

//$stmt = $conn->prepare('insert into number (num) values(:num)');
//
//foreach (range(1, 100) as $_) {
//    $num = rand(1, 100);
//
//    $stmt->bindValue(':num', $num);
//
//    $stmt->execute();
//}

// $stmt = $conn->prepare('select * from number where num > :threshold');
//$stmt = $conn->prepare('select num as my_number from number where num > :threshold');
//
//$stmt->bindValue(':threshold', 80);
//
//$stmt->execute();
//
//foreach ($stmt as $row) {
//    var_dump($row['my_number']);
//    var_dump($row[0]);
//}

$stmt = $conn->prepare('insert into contact (name) values (:name)');

$stmt->bindValue(':name', 'Jill');

$stmt->execute();

$lastInsertId = $conn->lastInsertId();

$phones = ['987', '654', '321'];

$stmt = $conn->prepare('insert into phone values (:contact_id, :number)');

foreach ($phones as $phone) {
    $stmt->bindValue(':contact_id', $lastInsertId);
    $stmt->bindValue(':number', $phone);
    $stmt->execute();
}

var_dump($lastInsertId);






