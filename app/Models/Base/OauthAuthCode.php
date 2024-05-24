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
 * Class OauthAuthCode
 * 
 * @property string $id
 * @property string $user_id
 * @property string $client_id
 * @property string|null $scopes
 * @property bool $revoked
 * @property Carbon|null $expires_at
 *
 * @package App\Models\Base
 */
class OauthAuthCode extends Model
{
	use HasUuid;
	use HasFactory;
	const ID = 'id';
	const USER_ID = 'user_id';
	const CLIENT_ID = 'client_id';
	const SCOPES = 'scopes';
	const REVOKED = 'revoked';
	const EXPIRES_AT = 'expires_at';
	protected $table = 'oauth_auth_codes';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		self::ID => 'string',
		self::USER_ID => 'string',
		self::CLIENT_ID => 'string',
		self::REVOKED => 'bool',
		self::EXPIRES_AT => 'datetime'
	];

	protected $fillable = [
		self::USER_ID,
		self::CLIENT_ID,
		self::SCOPES,
		self::REVOKED,
		self::EXPIRES_AT
	];
}
