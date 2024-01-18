<?php

namespace Icekristal\EmailValidationForLaravel\Services;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Interfaces\ValidationInterface;

class SmtpBz extends Verification implements ValidationInterface
{

    public function __construct()
    {
        parent::__construct();
        $this->apiKey = config('email_validation.services.smtpbz.api_key');
        $this->url = config('email_validation.services.smtpbz.api_url');
    }

    public function sendRequest(): PromiseInterface|Response
    {
        return Http::timeout($this->timeout)->withHeaders([
            'Authorization' => $this->apiKey
        ])->get($this->url . "/" . $this->email);
    }


    public function isValid(): bool
    {
        $this->response = $this->sendRequest();
        if ($this->response->status() == 200 && $this->response['result']) {
            return true;
        }
        return false;
    }
}
