<?php

namespace Tests\Unit\Application\UseCase;

use App\Application\UseCase\RegisterUserUseCase;
use App\Application\UseCase\RegisterUserRequest;
use App\Application\UseCase\UserResponseDTO;
use App\Domain\Model\User\User;
use App\Domain\Model\User\UserEmail;
use App\Domain\Model\User\UserId;
use App\Domain\Model\User\UserName;
use App\Domain\Model\User\UserPassword;
use App\Domain\Repository\UserRepositoryInterface;
use App\Shared\Exception\UserAlreadyExistsException;
use PHPUnit\Framework\TestCase;

class RegisterUserUseCaseTest extends TestCase
{
    public function testRegisterUser(): void
    {
        //Irrelevant
            //Create User
        //Initial State
            //Parameters: name, email and password
        //Action
            //Verify that the parameters are passed to the function
            //Creates the object responsible for creating the user
            //the function that the user will create is called
            //Verify email. It is verified that the email address passed as a parameter does not exist. If it does, an exception will be returned.
            //Save user. If the email does not exist, then the new user is created.
        //Outcome
            //json with the user's ID, name and email
            //expected name: Christian
            //expected email: christian.gaviria@gmail.com

        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $userRepository->method('findByEmail')->willReturn(null);
        $userRepository->expects($this->once())->method('save');

        $useCase = new RegisterUserUseCase($userRepository);
        $request = new RegisterUserRequest('Christian', 'christian.gaviria@gmail.com', 'P@ssword123');
        $response = $useCase->execute($request);

        $this->assertInstanceOf(UserResponseDTO::class, $response);
        $this->assertNotNull($response->getId());
        $this->assertEquals('Christian', $response->getName());
        $this->assertEquals('christian.gaviria@gmail.com', $response->getEmail());
    }

    public function testRegisterUserWithExistingEmail(): void
    {
        //Irrelevant
            //Create User
        //Initial State
            //Parameters: name, email and password
        //Action
            //Verify that the parameters are passed to the function
            //Creates the object responsible for creating the user
            //the function that the user will create is called
            //Verify email. It is verified that the email address passed as a parameter does not exist. If it does, an exception will be returned.
        //Outcome
            //expected Exception: Christian

        $this->expectException(UserAlreadyExistsException::class);
        $this->expectExceptionMessage('A user with this email already exists');

        $existingUser = new User(
            new UserId(),
            new UserName('Christian'),
            new UserEmail('christian.gaviria@gmail.com'),
            new UserPassword('P@ssword123')
        );

        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $userRepository->method('findByEmail')->willReturn($existingUser);

        $useCase = new RegisterUserUseCase($userRepository);
        $request = new RegisterUserRequest('Christian', 'Christian@gmail.com', 'P@ssword123');
        $useCase->execute($request);
    }
}
