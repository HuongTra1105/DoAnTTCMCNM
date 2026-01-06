<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietGioHang extends Model
{
    protected $table = 'ctgiohang';

    protected $fillable = [
        'Macart',
        'Masanpham',
        'Gia',
        'Soluong'
    ];

    public function sanPham()
    {
        return $this->belongsTo(Products::class, 'Masanpham');
    }
}
