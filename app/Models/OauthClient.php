<?php

namespace App\Models;

use App\Models\Base\OauthClient as BaseOauthClient;

class OauthClient extends BaseOauthClient
{
	protected $hidden = [
		self::SECRET
	];
}
