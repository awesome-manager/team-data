<?php

namespace App\Exceptions;

use Awesome\Rest\Exceptions\AbstractException;

class VacationsNotFound extends AbstractException
{
    const SYMBOLIC_CODE = 'vacations_not_found';
}
