<?php

namespace App\Models\Product;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
  use HasFactory;
  use SoftDeletes;
  protected $fillable = [
    "name",
    "icon",
    "imagen",
    "second_id",
    "third_id",
    "position",
    "type",
    "state"
  ];

  public function setCreatedAtAttribute($value)
  {
    date_default_timezone_set("America/Lima");
    $this->attributes["created_at"] = Carbon::now();
  }
  public function setUpdatedAtAttribute($value)
  {
    date_default_timezone_set("America/Lima");
    $this->attributes["updated_at"] = Carbon::now();
  }

  public function category_second()
  {
    return $this->belongsTo(Category::class, "second_id");
  }

  public function category_third()
  {
    return $this->belongsTo(Category::class, "third_id");
  }
}
