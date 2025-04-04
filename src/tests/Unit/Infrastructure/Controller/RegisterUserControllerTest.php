<?php

namespace App\Tests\Unit\Infrastructure\Controller;

use App\Infrastructure\Controller\RegisterUserController;
use App\Domain\Repository\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

class RegisterUserControllerTest extends TestCase
{
    private $userRepository;
    private $controller;

    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->controller = new RegisterUserController($this->userRepository);
    }

    public function testRegisterSuccess()
    {
        $requestData = [
            'name' => 'Christian',
            'email' => 'Christian.gaviria@gmail.com',
            'password' => 'StrongP@ssw&rd123'
        ];

        $this->userRepository->expects($this->once())
            ->method('save');

        $response = $this->controller->register($requestData);

        $this->assertEquals(201, $response['status']);
    }

    public function testRegisterValidationError()
    {
        $requestData = [
            'name' => '',
            'email' => 'invalid-email',
            'password' => 'StrongPassword123'
        ];

        $response = $this->controller->register($requestData);

        $this->assertEquals(400, $response['status']);
        $this->assertArrayHasKey('error', $response['body']);
    }

    public function testRegisterRepositoryException()
    {
        $requestData = [
            'name' => 'Christian',
            'email' => 'Christian.gaviria@gmail.com',
            'password' => 'StrongP@ssw&rd123'
        ];

        $this->userRepository->expects($this->once())
            ->method('save')
            ->will($this->throwException(new \Exception('Database error')));

        $response = $this->controller->register($requestData);

        $this->assertEquals(500, $response['status']);
        $this->assertEquals(['error' => 'Internal server error'], $response['body']);
    }
}