<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'store_id',
        'product_category_id',
        'name',
        'slug',
        'short_description',
        'short_description_id',
        'description',
        'description_id',
        'condition',
        'price',
        'weight',
        'stock',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function getLocalizedDescriptionAttribute()
    {
        if (app()->getLocale() == 'id' && !empty($this->description_id)) {
            return $this->description_id;
        }
        return $this->description;
    }

    public function getLocalizedShortDescriptionAttribute()
    {
        if (app()->getLocale() == 'id' && !empty($this->short_description_id)) {
            return $this->short_description_id;
        }
        return $this->short_description;
    }
}
