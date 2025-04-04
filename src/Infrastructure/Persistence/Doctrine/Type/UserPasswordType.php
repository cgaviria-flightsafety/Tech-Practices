<?php

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\Model\User\UserPassword;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class UserPasswordType extends StringType
{
    public function getName(): string
    {
        return 'name';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?UserPassword
    {
        return !empty($value) ? new UserPassword($value) : null;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof UserPassword ? $value->getPasswordHash() : null;
    }
}