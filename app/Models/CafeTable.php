<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CafeTable extends Model
{
    protected $table = 'cafe_tables';
    protected $primaryKey = 'table_id';

    protected $fillable = [
        'table_number',
        'qr_token',
    ];

    /**
     * Generate token unik baru untuk meja ini
     */
    public function regenerateToken(): void
    {
        $this->qr_token = Str::uuid();
        $this->save();
    }

    /**
     * URL target untuk QR Code meja ini
     */
    public function getQrUrlAttribute(): string
    {
        return url('/table/' . $this->table_number);
    }
}