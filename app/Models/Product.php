<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'user_id',
        'title',
        'description',
        'price',
        'image1',
        'image2',
        'image3',
        'features',
        'status',
        'seller_name',
        'phone',
        'hide_phone',
        'location',
        'is_premium',
        'stripe_payment_id',
        'payment_method'
    ];
    protected $guarded = [];
    protected $casts = [
        'features' => 'array',
    ];    

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
}

}
