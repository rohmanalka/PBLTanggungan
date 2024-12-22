<?php
$hash = '$2y$10$FWE61jCR0MiG4OJUb.9e/eC2iDYgYraK4BsrjDAfMxMZVCV0SBQEa'; // Hash password di database
$passwordInput = '12345678';

if (password_verify($passwordInput, $hash)) {
    echo "Password cocok!";
} else {
    echo "Password tidak cocok!";
}
?>
