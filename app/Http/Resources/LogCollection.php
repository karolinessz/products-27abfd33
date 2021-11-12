<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Helpers\Format;

class LogCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($item, $key) {
                return [
                    'id' => $item->id,
                    'sku' => $item->sku,
                    'description' => $item->description,
                    'created_at' => Format::formatDate($item->created_at),
                ];
            })
        ];
    }
}
