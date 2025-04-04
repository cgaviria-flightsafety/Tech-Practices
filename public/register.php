<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../doctrine-config.php';

use App\Infrastructure\Controller\RegisterUserController;
use App\Domain\Repository\DoctrineUserRepository;

$userRepository = new DoctrineUserRepository($entityManager);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ];

    $controller = new RegisterUserController($userRepository);
    $response = $controller->register($requestData);

    http_response_code($response['status']);
    header('Content-Type: application/json');
    echo json_encode($response['body']);
}

//vendor/phpunit/phpunit/phpunit src/tests/