<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    protected $table = 'giohang';

    protected $fillable = [
        'user_id',
        'Tongtien',
        'Trangthai'
    ];

    public function chiTiet()
    {
        return $this->hasMany(ChiTietGioHang::class, 'Macart');
    }
}