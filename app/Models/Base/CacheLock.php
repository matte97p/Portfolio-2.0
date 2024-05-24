<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CacheLock
 * 
 * @property string $key
 * @property string $owner
 * @property int $expiration
 *
 * @package App\Models\Base
 */
class CacheLock extends Model
{
	use HasUuid;
	use HasFactory;
	const KEY = 'key';
	const OWNER = 'owner';
	const EXPIRATION = 'expiration';
	protected $table = 'cache_locks';
	protected $primaryKey = 'key';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		self::EXPIRATION => 'int'
	];

	protected $fillable = [
		self::OWNER,
		self::EXPIRATION
	];
}
