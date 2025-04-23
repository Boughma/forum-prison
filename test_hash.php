<?php
$password = 'admin2025';
$hash = '$2y$10$8U9dlZD5KJoPKbzT6K5xeOBwE1aLdM3qblK1b6Bk0rYoTKzyqYNOu';

var_dump(password_verify($password, $hash)); // Doit afficher bool(true)
