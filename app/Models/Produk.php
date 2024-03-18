<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nama', 'harga', 'stok'];

    protected $hidden = ['created_at', 'updated_at'];

    public function getHargaAttribute($value)
    {
        return "Rp " . number_format($value, 0, ',', '.');
    }

    public function setHargaAttribute($value)
    {
        $this->attributes['harga'] = str_replace(['Rp', '.', ' '], '', $value);
    }

    public function getStokAttribute($value)
    {
        return $value . " pcs";
    }

    public function setStokAttribute($value)
    {
        $this->attributes['stok'] = str_replace(['pcs'], '', $value);
    }

    public function getDeletedAtColumn()
    {
        return 'deleted_at';
    }
}
