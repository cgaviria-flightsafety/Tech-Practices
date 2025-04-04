<?php

namespace App\Application\UseCase;

use App\Domain\Model\User\User;
use App\Domain\Model\User\UserId;
use App\Domain\Model\User\UserName;
use App\Domain\Model\User\UserEmail;
use App\Domain\Model\User\UserPassword;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Event\UserRegisteredEvent;
use App\Domain\Event\UserRegisteredEventHandler;
use App\Shared\Exception\UserAlreadyExistsException;

class RegisterUserUseCase
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(RegisterUserRequest $request): UserResponseDTO
    {
        $email = new UserEmail($request->getEmail());

        if($this->userRepository->findByEmail($email) !== null){
            throw new UserAlreadyExistsException("A user with this email already exists");
        }

        $user = new User(
            new UserId(),
            new UserName($request->getName()),
            $email,
            new UserPassword($request->getPassword())
        );

        $this->userRepository->save($user);

        $event = new UserRegisteredEvent($user);
        $handler = new UserRegisteredEventHandler();
        $message = $handler->handle($event);

        return new UserResponseDTO(
            (string) $user->getId(),
            (string) $user->getName(),
            (string) $user->getEmail(),
            $message,
        );
    }
}