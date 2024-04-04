<?php

require_once '../connection.php';
require_once 'Contact.php';

function getContacts(): array {
    $conn = getConnection();

    $stmt = $conn->prepare('SELECT id, name, number FROM contact c left join phone p on c.id = p.contact_id');

    $stmt->execute();

    $contacts = [];

    foreach ($stmt as $row) {
        $id = $row['id'];
        $name = $row['name'];
        $number = $row['number'];

        if (isset($contacts[$id])) {
            $contact = $contacts[$id];
        } else {
            $contact = new Contact($id, $name);
            $contacts[$id] = $contact;
        }
        if ($number !== null) {
            $contact->addPhone($number);
        }
    }

    return array_values($contacts);
}