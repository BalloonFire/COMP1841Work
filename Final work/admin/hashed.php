<?php
$passwords = [
    'AAAAA',
    'ByeBye',
    'ComeOn',
    'CCC',
    'Cx',
    'test',
    'admin',
    'New'
];

foreach ($passwords as $password) {
    $hashedPassword = hash('sha256', $password);
    echo "Original: $password, Hashed: $hashedPassword<br>";
}