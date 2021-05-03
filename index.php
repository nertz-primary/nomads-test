<?php

spl_autoload_register(function ($class_name) {
    include __DIR__ . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR .   $class_name . '.php';
});

$customer = new Customer(1, 'John', 100.55, 34);
$seller = new Seller(2, 'Alex', 550.87, 781);
$administrator = new Administrator(3, 'Arnold', '{reports, sales, users}');

$userManager = new UserManager();

echo $userManager->getUserInfo($customer);
echo $userManager->getUserInfo($seller);
echo $userManager->getUserInfo($administrator);