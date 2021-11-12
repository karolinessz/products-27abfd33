<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Log;

class ProductService
{

	public function storeNewProduct(
		string $sku,
		string $name,
		int $stock,
		string $price
	): Product {
		$product = Product::create([
			'sku' => $sku,
			'name' => $name,
			'stock' => $stock,
			'price' => $price,
		]);

		return $product;
	}

	public function updateProduct(
		Product $product,
		$request
	) {

		$product->update(
			$request->only([
				'stock', 'price'
			])
		);

		return $product;
	}
}
