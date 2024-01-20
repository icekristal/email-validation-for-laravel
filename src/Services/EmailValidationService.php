<?php

namespace Icekristal\EmailValidationForLaravel\Services;

use Icekristal\EmailValidationForLaravel\Models\EmailValidationService as EmailValidationModel;
use Illuminate\Support\Facades\Log;

class EmailValidationService
{
    private array $enableService;
    private string $email;

    public string $url;

    public function __construct()
    {
        $this->enableService = config('email_validation.enable_services');
    }

    public function isValidate(): bool
    {
        $isCheckDb = $this->isCheckDb();
        $resultValid = [];
        $isValid = false;
        if (!is_null($isCheckDb)) return $isCheckDb;
        foreach ($this->enableService as $service) {
            $class = config('email_validation.services.' . $service);
            if (is_null($class['api_key'])) continue;

            $validClass = new $class['class'];
            $validClass->setEmail($this->email);
            try {
                $isValid = $validClass->isValid();
                $isShutDownService = false;
                $this->saveDb([
                    'is_valid' => $isValid,
                    'service' => $service,
                    'response' => $validClass->response ?? null,
                    'response_status' => $validClass->response->status() ?? null,
                    'response_at' => now()
                ]);
            } catch (\Exception $exception) {
                $isValid = config('email_validation.is_valid_email_shutdown_service', true);
                $isShutDownService = true;
                Log::error($exception->getMessage());
            }

            $resultValid[$service] = [
                'is_valid' => $isValid,
                'is_shut_down_service' => $isShutDownService,
            ];

            if (!config('email_validation.is_check_multiple') && !$isShutDownService) {
                break;
            }
        }

        foreach ($resultValid as $info) {
            if (isset($info['is_valid']) && $info['is_valid'] && !config('email_validation.is_check_multiple')) {
                return $info['is_valid'];
            }
        }

        if (config('email_validation.is_check_multiple')) {
            $countCheck = count($resultValid);
            if ($countCheck === 1) return isset($resultValid[0]['is_valid']) && $resultValid[0]['is_valid'];
            if ($countCheck === 2) return isset($resultValid[0]['is_valid']) && $resultValid[0]['is_valid'] && isset($resultValid[1]['is_valid']) && $resultValid[1]['is_valid'];
            $majority = round($countCheck / 2);
            $isValidCount = 0;
            foreach ($resultValid as $item) {
                if (isset($item['is_valid']) && $item['is_valid']) $isValidCount++;
            }
            if ($isValidCount >= $majority) return true;
        }

        return $isValid;
    }

    private function saveDb(array $params): void
    {
        if (!config('email_validation.is_use_save_db')) return;
        $params['email'] = $this->email;
        $modelValid = \Icekristal\EmailValidationForLaravel\Models\EmailValidationService::query()
            ->where('service', $params['service'])
            ->where('email', $params['email'])
            ->first();

        if (is_null($modelValid)) {
            $params['count_request'] = 1;
            \Icekristal\EmailValidationForLaravel\Models\EmailValidationService::query()->create($params);
        } else {
            $params['count_request'] = $modelValid->count_request + 1;
            $modelValid->update($params);
        }
    }

    public function getEnableService(): array
    {
        return $this->enableService;
    }


    public function isCheckDb(): bool|null
    {
        if (!config('email_validation.is_use_save_db')) return null;
        $modelCheck = EmailValidationModel::query()
            ->where('email', $this->email)
            ->first();

        if (is_null($modelCheck)) return null;
        return $modelCheck->is_valid;
    }

    public function setEmail(string $email): EmailValidationService
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
