<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Session
 * 
 * @property string $id
 * @property string|null $user_id
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string $payload
 * @property int $last_activity
 *
 * @package App\Models\Base
 */
class Session extends Model
{
	use HasUuid;
	use HasFactory;
	const ID = 'id';
	const USER_ID = 'user_id';
	const IP_ADDRESS = 'ip_address';
	const USER_AGENT = 'user_agent';
	const PAYLOAD = 'payload';
	const LAST_ACTIVITY = 'last_activity';
	protected $table = 'sessions';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		self::ID => 'string',
		self::USER_ID => 'string',
		self::LAST_ACTIVITY => 'int'
	];

	protected $fillable = [
		self::USER_ID,
		self::IP_ADDRESS,
		self::USER_AGENT,
		self::PAYLOAD,
		self::LAST_ACTIVITY
	];
}
