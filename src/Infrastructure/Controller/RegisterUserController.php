<?php

namespace App\Infrastructure\Controller;

use App\Application\UseCase\RegisterUserUseCase;
use App\Application\UseCase\RegisterUserRequest;
use App\Domain\Repository\UserRepositoryInterface;
class RegisterUserController
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $requestData): array
    {
        try {
            if (!isset($requestData['name']) || !isset($requestData['email']) || !isset($requestData['password'])) {
                return [
                    'status' => 400,
                    'body' => ['error' => 'Missing required fields'],
                ];
            }

            $registerUserRequest = new RegisterUserRequest(
                $requestData['name'],
                $requestData['email'],
                $requestData['password']
            );

            $registerUserUseCase = new RegisterUserUseCase($this->userRepository);
            $userResponseDTO = $registerUserUseCase->execute($registerUserRequest);

            return [
                'status' => 201,
                'body' => $userResponseDTO->toArray(),
            ];
        } catch (\InvalidArgumentException $e) {
            return [
                'status' => 400,
                'body' => ['error' => $e->getMessage()],
            ];
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'body' => ['error' => 'Internal server error'],
            ];
        }
    }
}
