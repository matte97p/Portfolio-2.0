<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Job
 * 
 * @property string $id
 * @property string $queue
 * @property string $payload
 * @property int $attempts
 * @property Carbon|null $reserved_at
 * @property Carbon $available_at
 * @property Carbon $created_at
 *
 * @package App\Models\Base
 */
class Job extends Model
{
	use HasUuid;
	use HasFactory;
	const ID = 'id';
	const QUEUE = 'queue';
	const PAYLOAD = 'payload';
	const ATTEMPTS = 'attempts';
	const RESERVED_AT = 'reserved_at';
	const AVAILABLE_AT = 'available_at';
	const CREATED_AT = 'created_at';
	protected $table = 'jobs';
	public $timestamps = false;

	protected $casts = [
		self::ID => 'string',
		self::ATTEMPTS => 'int',
		self::RESERVED_AT => 'datetime',
		self::AVAILABLE_AT => 'datetime',
		self::CREATED_AT => 'datetime'
	];

	protected $fillable = [
		self::QUEUE,
		self::PAYLOAD,
		self::ATTEMPTS,
		self::RESERVED_AT,
		self::AVAILABLE_AT
	];
}
