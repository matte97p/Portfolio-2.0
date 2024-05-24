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
 * Class OauthClient
 * 
 * @property string $id
 * @property string|null $user_id
 * @property string $name
 * @property string|null $secret
 * @property string|null $provider
 * @property string $redirect
 * @property bool $personal_access_client
 * @property bool $password_client
 * @property bool $revoked
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models\Base
 */
class OauthClient extends Model
{
	use HasUuid;
	use HasFactory;
	const ID = 'id';
	const USER_ID = 'user_id';
	const NAME = 'name';
	const SECRET = 'secret';
	const PROVIDER = 'provider';
	const REDIRECT = 'redirect';
	const PERSONAL_ACCESS_CLIENT = 'personal_access_client';
	const PASSWORD_CLIENT = 'password_client';
	const REVOKED = 'revoked';
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
	protected $table = 'oauth_clients';
	public $incrementing = false;

	protected $casts = [
		self::ID => 'string',
		self::USER_ID => 'string',
		self::PERSONAL_ACCESS_CLIENT => 'bool',
		self::PASSWORD_CLIENT => 'bool',
		self::REVOKED => 'bool',
		self::CREATED_AT => 'datetime',
		self::UPDATED_AT => 'datetime'
	];

	protected $fillable = [
		self::USER_ID,
		self::NAME,
		self::SECRET,
		self::PROVIDER,
		self::REDIRECT,
		self::PERSONAL_ACCESS_CLIENT,
		self::PASSWORD_CLIENT,
		self::REVOKED
	];
}
