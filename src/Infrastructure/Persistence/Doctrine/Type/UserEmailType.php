<?php

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\Model\User\UserEmail;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class UserEmailType extends StringType
{
    public function getName(): string
    {
        return 'email';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?UserEmail
    {
        return !empty($value) ? new UserEmail($value) : null;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof UserEmail ? $value->getEmail() : null;
    }
}