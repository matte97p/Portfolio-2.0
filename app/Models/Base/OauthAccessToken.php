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
 * Class OauthAccessToken
 * 
 * @property string $id
 * @property string|null $user_id
 * @property string $client_id
 * @property string|null $name
 * @property string|null $scopes
 * @property bool $revoked
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $expires_at
 *
 * @package App\Models\Base
 */
class OauthAccessToken extends Model
{
	use HasUuid;
	use HasFactory;
	const ID = 'id';
	const USER_ID = 'user_id';
	const CLIENT_ID = 'client_id';
	const NAME = 'name';
	const SCOPES = 'scopes';
	const REVOKED = 'revoked';
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
	const EXPIRES_AT = 'expires_at';
	protected $table = 'oauth_access_tokens';
	public $incrementing = false;

	protected $casts = [
		self::ID => 'string',
		self::USER_ID => 'string',
		self::CLIENT_ID => 'string',
		self::REVOKED => 'bool',
		self::CREATED_AT => 'datetime',
		self::UPDATED_AT => 'datetime',
		self::EXPIRES_AT => 'datetime'
	];

	protected $fillable = [
		self::USER_ID,
		self::CLIENT_ID,
		self::NAME,
		self::SCOPES,
		self::REVOKED,
		self::EXPIRES_AT
	];
}
