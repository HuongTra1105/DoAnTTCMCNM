<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    protected $table = 'ctdonhang';

    protected $fillable = [
        'Madonhang',
        'Masanpham',
        'Tensanpham',
        'Gia',
        'Soluong'
    ];
}
