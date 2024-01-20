<?php

namespace Icekristal\EmailValidationForLaravel\Services;

use GuzzleHttp\Promise\PromiseInterface;
use Icekristal\EmailValidationForLaravel\Interfaces\ValidationInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class AbstractApi extends Verification implements ValidationInterface
{

    public function __construct()
    {
        parent::__construct();
        $this->apiKey = config('email_validation.services.abstractapi.api_key');
        $this->url = config('email_validation.services.abstractapi.api_url');
    }


    public function sendRequest(): PromiseInterface|Response
    {
        return Http::timeout($this->timeout)->get($this->url, [
            'api_key' => $this->apiKey,
            'email' => $this->email
        ]);
    }


    public function isValid(): bool
    {
        $this->response = $this->sendRequest();
        if (isset($this->response['email']) && isset($this->response['deliverability'])) {
            if ($this->response['deliverability'] === 'DELIVERABLE') {
                return true;
            }
        }
        return false;
    }
}
