<?php

namespace Icekristal\EmailValidationForLaravel\Interfaces;

interface ValidationInterface
{
    public function sendRequest();

    public function isValid();
}
