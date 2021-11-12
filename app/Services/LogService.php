<?php

namespace App\Services;

use App\Models\Log;

class LogService
{
	public function storeLog(
		string $sku,
		array $description
	) : Log {
		$log = Log::create([
			'sku' => $sku,
			'description' => json_encode($description),
		]);

		return $log;
	}
}
