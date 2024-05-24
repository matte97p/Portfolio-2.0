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
 * Class OauthRefreshToken
 * 
 * @property string $id
 * @property string $access_token_id
 * @property bool $revoked
 * @property Carbon|null $expires_at
 *
 * @package App\Models\Base
 */
class OauthRefreshToken extends Model
{
	use HasUuid;
	use HasFactory;
	const ID = 'id';
	const ACCESS_TOKEN_ID = 'access_token_id';
	const REVOKED = 'revoked';
	const EXPIRES_AT = 'expires_at';
	protected $table = 'oauth_refresh_tokens';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		self::ID => 'string',
		self::ACCESS_TOKEN_ID => 'string',
		self::REVOKED => 'bool',
		self::EXPIRES_AT => 'datetime'
	];

	protected $fillable = [
		self::ACCESS_TOKEN_ID,
		self::REVOKED,
		self::EXPIRES_AT
	];
}
