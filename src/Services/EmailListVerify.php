<?php

namespace Icekristal\EmailValidationForLaravel\Services;

use GuzzleHttp\Promise\PromiseInterface;
use Icekristal\EmailValidationForLaravel\Interfaces\ValidationInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class EmailListVerify extends Verification implements ValidationInterface
{

    public function __construct()
    {
        parent::__construct();
        $this->apiKey = config('email_validation.services.emaillistverify.api_key');
        $this->url = config('email_validation.services.emaillistverify.api_url');
    }


    public function sendRequest(): PromiseInterface|Response
    {
        return Http::timeout($this->timeout)->get($this->url, [
            'secret' => $this->apiKey,
            'email' => $this->email
        ]);
    }


    public function isValid(): bool
    {
        $this->response = $this->sendRequest();
        if ($this->response->status() == 200 && in_array($this->response, ['ok', 'ok_for_all'])) {
            return true;
        }
        return false;
    }
}
