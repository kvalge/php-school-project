<?php

require_once '../vendor/tpl.php';
require_once 'Book.php';
require_once 'Author.php';

$book = new Book('Head First HTML and CSS', 3, true);
$book->addAuthor(new Author('Elisabeth', 'Robson'));
$book->addAuthor(new Author('Eric', 'Freeman'));


$data = ['books' => [$book]
];

print renderTemplate('list.html', $data);
