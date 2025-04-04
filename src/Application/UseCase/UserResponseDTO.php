<?php

namespace App\Application\UseCase;

class UserResponseDTO
{
    private string $id;
    private string $name;
    private string $email;
    private string $event;
    public function __construct(string $id, string $name, string $email, string $event)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->event = $event;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getEvent(): string
    {
        return $this->event;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'event' => $this->getEvent(),
        ];
    }
}
