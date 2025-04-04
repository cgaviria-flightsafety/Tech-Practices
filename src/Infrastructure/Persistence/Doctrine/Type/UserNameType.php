<?php

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\Model\User\UserName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class UserNameType extends StringType
{
    public function getName(): string
    {
        return 'name';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?UserName
    {
        return !empty($value) ? new UserName($value) : null;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof UserName ? $value->getName() : null;
    }
}