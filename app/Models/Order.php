<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    protected $fillable = [
        'table_id',
        'order_code',
        'customer_name',
        'status',
        'total_amount',
    ];
    protected $casts = [
        'total_amount' => 'integer',
    ];

    /**
     * An order has many order detail lines.
     */
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }

    /**
     * Recalculate and persist total_amount from current order details.
     */
    public function recalculateTotal(): void
    {
        $this->total_amount = $this->orderDetails()->sum('subtotal');
        $this->save();
    }

    /**
     * Format total to Indonesian Rupiah.
     */
    public function getTotalFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }
}