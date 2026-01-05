<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'donhang';

    protected $fillable = [
        'user_id',
        'Tongtien',
        'Hoten',
        'Sodienthoai',
        'Diachi',
        'Ghichu',
        'Trangthai',
        'TrangThaiTT'
    ];

    public function chiTiet()
    {
        return $this->hasMany(ChiTietDonHang::class, 'Madonhang');
    }
}