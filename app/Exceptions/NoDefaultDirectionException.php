<?php

namespace App\Exceptions;

use Exception;

class NoDefaultDirectionException extends Exception
{
    private $institutionType;

    public function __construct($institutionType)
    {
        $this->institutionType = $institutionType;

        parent::__construct($this->message());
    }

    public function message()
    {
        return "Default direction for '{$this->institutionType}' is not found in database. " .
               "This will cause different application errors. " .
               "Make sure there are default directions for all of the institution types.";
    }
}
