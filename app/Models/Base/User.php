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
 * Class User
 * 
 * @property string $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models\Base
 */
class User extends Model
{
	use HasUuid;
	use HasFactory;
	const ID = 'id';
	const NAME = 'name';
	const EMAIL = 'email';
	const EMAIL_VERIFIED_AT = 'email_verified_at';
	const PASSWORD = 'password';
	const REMEMBER_TOKEN = 'remember_token';
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
	protected $table = 'users';

	protected $casts = [
		self::ID => 'string',
		self::EMAIL_VERIFIED_AT => 'datetime',
		self::CREATED_AT => 'datetime',
		self::UPDATED_AT => 'datetime'
	];

	protected $fillable = [
		self::NAME,
		self::EMAIL,
		self::EMAIL_VERIFIED_AT,
		self::PASSWORD
	];
}
