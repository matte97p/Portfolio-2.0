<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cache
 * 
 * @property string $key
 * @property string $value
 * @property int $expiration
 *
 * @package App\Models\Base
 */
class Cache extends Model
{
	use HasUuid;
	use HasFactory;
	const KEY = 'key';
	const VALUE = 'value';
	const EXPIRATION = 'expiration';
	protected $table = 'cache';
	protected $primaryKey = 'key';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		self::EXPIRATION => 'int'
	];

	protected $fillable = [
		self::VALUE,
		self::EXPIRATION
	];
}
