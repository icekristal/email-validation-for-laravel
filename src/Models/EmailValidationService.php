<?php
namespace Icekristal\EmailValidationForLaravel\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $count_request
 * @property string $service
 * @property string $email
 * @property boolean $is_valid
 * @property object $response
 * @property Carbon $response_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ServiceUniteller extends Model
{
    /**
     *
     * Name Table
     * @var string
     */
    protected $table = 'email_validation_services';


    protected $fillable = [
        'count_request',
        'service',
        'email',
        'is_valid',
        'response',
        'response_at',
        'created_at',
        'updated_at',
    ];

    /**
     *
     * Mutation
     *
     * @var array
     */
    protected $casts = [
        'count_request' => 'integer',
        'service' => 'string',
        'email' => 'string',
        'is_valid' => 'boolean',
        'response' => 'object',
        'response_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
