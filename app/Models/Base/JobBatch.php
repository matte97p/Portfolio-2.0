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
 * Class JobBatch
 * 
 * @property string $id
 * @property string $name
 * @property int $total_jobs
 * @property int $pending_jobs
 * @property int $failed_jobs
 * @property string $failed_job_ids
 * @property string|null $options
 * @property Carbon|null $cancelled_at
 * @property Carbon $created_at
 * @property Carbon|null $finished_at
 *
 * @package App\Models\Base
 */
class JobBatch extends Model
{
	use HasUuid;
	use HasFactory;
	const ID = 'id';
	const NAME = 'name';
	const TOTAL_JOBS = 'total_jobs';
	const PENDING_JOBS = 'pending_jobs';
	const FAILED_JOBS = 'failed_jobs';
	const FAILED_JOB_IDS = 'failed_job_ids';
	const OPTIONS = 'options';
	const CANCELLED_AT = 'cancelled_at';
	const CREATED_AT = 'created_at';
	const FINISHED_AT = 'finished_at';
	protected $table = 'job_batches';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		self::ID => 'string',
		self::TOTAL_JOBS => 'int',
		self::PENDING_JOBS => 'int',
		self::FAILED_JOBS => 'int',
		self::CANCELLED_AT => 'datetime',
		self::CREATED_AT => 'datetime',
		self::FINISHED_AT => 'datetime'
	];

	protected $fillable = [
		self::NAME,
		self::TOTAL_JOBS,
		self::PENDING_JOBS,
		self::FAILED_JOBS,
		self::FAILED_JOB_IDS,
		self::OPTIONS,
		self::CANCELLED_AT,
		self::FINISHED_AT
	];
}
