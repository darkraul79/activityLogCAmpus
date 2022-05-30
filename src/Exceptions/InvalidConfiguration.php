<?php

namespace Darkraul79\Activitylogcampus\Exceptions;

use Exception;
use Darkraul79\Activitylogcampus\Models\Activity;

class InvalidConfiguration extends Exception
{
    public static function modelIsNotValid(string $className)
    {
        return new static("The given model class `$className` does not extend `" . Activity::class . '`');
    }
}
