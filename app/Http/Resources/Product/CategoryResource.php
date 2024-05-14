<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      "id" => $this->resource->id,
      "name" => $this->resource->name,
      "icon" => $this->resource->icon,
      "imagen" => $this->resource->imagen ? env("APP_URL") . "storage/" . $this->resource->imagen : NULL,
      "second_id" => $this->resource->second_id,
      "second" => $this->resource->category_second ? [
        "name" => $this->resource->category_second->name
      ] : NULL,
      "third_id" => $this->resource->third_id,
      "third" => $this->resource->category_third ? [
        "name" => $this->resource->category_third->name
      ]: NULL,
      "position" => $this->resource->position,
      "type" => $this->resource->type,
      "state" => $this->resource->state,
      "created_at" => $this->resource->created_at->format("Y-m-d h:i:s")
    ];
  }
}