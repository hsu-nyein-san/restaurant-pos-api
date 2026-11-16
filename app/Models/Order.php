<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'order_number',
        'restaurant_table_id',
        'status',
        'subtotal',
        'discount',
        'tax',
        'total'
    ];

    public function items():HasMany
    {
        return $this->hasMany(OrderItem::class);
    }


    public function restaurantTable():BelongsTo
    {
        return $this->belongsTo(RestaurantTable::class);
    }


}
