<?php

namespace App\Models\Product;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "title",
        "slug",
        "sku",
        "precio_pen",
        "precie_usd",
        "resumen",
        "imagen",
        "state",
        "description",
        "tags",
        "brand_id",
        "category_first_id",
        "category_second_id",
        "category_third_id",
        "stock"
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

    public function category_first()
    {
        return $this->belongsTo(Category::class, "category_first_id");
    }
    public function category_second()
    {
        return $this->belongsTo(Category::class, "category_second_id");
    }
    public function category_third()
    {
        return $this->belongsTo(Category::class, "category_third_id");
    }
    public function brand()
    {
        return $this->belongsTo(Category::class, "brand_id");
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, "product_id");
    }

    public function scopeFilterAdvanceProduct($query, $search, $category_first_id, $category_second_id, $category_third_id)
    {
        if ($search) {
            $query->where("title", "like", "%" . $search . "%");
        }
        if ($category_first_id) {
            $query->where("category_first_id", $category_first_id);
        }
        if ($category_second_id) {
            $query->where("category_second_id", $category_second_id);
        }
        if ($category_third_id) {
            $query->where("category_third_id", $category_third_id);
        }

        return $query;
    }
}
