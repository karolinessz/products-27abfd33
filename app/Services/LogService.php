<?php

namespace App\Services;

use App\Models\Log;
use App\Models\Product;

class LogService
{
	public function storeLog(
		object $product,
		array $changes,
		string $type
	): Log {

		$description = $this->getChanges($product, $changes, $type);

		$log = Log::create([
			'sku' => $product->sku,
			'description' => json_encode($description),
		]);

		return $log;
	}

	public function getChanges($product, $changes, $type)
	{
		$editedChanges = [];

		if ($type == 'edit') {
			if (array_key_exists('sku', $changes)) {
				$key = $changes['sku'];
				array_push($editedChanges, 'SKU de ' . $product->sku . ' para ' . $key);
			}

			if (array_key_exists('name', $changes)) {
				$key = $changes['name'];
				array_push($editedChanges, 'Nome de ' . $product->name . ' para ' . $key);
			}

			if (array_key_exists('price', $changes)) {
				$key = $changes['price'];
				array_push($editedChanges, 'Preço de ' . $product->price . ' para ' . $key);
			}

			if (array_key_exists('stock', $changes)) {
				$key = $changes['stock'];

				array_push($editedChanges, 'Quatidade de ' . $product->stock . ' para ' . $key);
			}
		} else {
			$editedChanges = $changes;
		}

		return $editedChanges;
	}
}
