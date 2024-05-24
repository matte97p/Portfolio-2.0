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
 * Class OauthPersonalAccessClient
 * 
 * @property string $id
 * @property string $client_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models\Base
 */
class OauthPersonalAccessClient extends Model
{
	use HasUuid;
	use HasFactory;
	const ID = 'id';
	const CLIENT_ID = 'client_id';
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
	protected $table = 'oauth_personal_access_clients';

	protected $casts = [
		self::ID => 'string',
		self::CLIENT_ID => 'string',
		self::CREATED_AT => 'datetime',
		self::UPDATED_AT => 'datetime'
	];

	protected $fillable = [
		self::CLIENT_ID
	];
}
