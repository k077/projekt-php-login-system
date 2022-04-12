<?php

class RegistrationStatus
{
    public bool $success = true;
    public ?string $error = null;

    public function __construct($error = null)
    {
        if (isset($error))
            $this->success = false;
        $this->error = $error;
    }
}