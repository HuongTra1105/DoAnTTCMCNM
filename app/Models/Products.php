<?php

namespace App\Models;
use App\Models\AnhSanPham;
use Illuminate\Database\Eloquent\Model;
use App\Models\Choice;
class Products extends Model
{
   protected $table = 'sanpham';

     public function images()
    {
        return $this->hasMany(AnhSanPham::class, 'Masanpham');
    }

    public function mainImage()
    {
        return $this->hasOne(AnhSanPham::class, 'Masanpham')
                    ->where('Anhchinh', 1);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class, 'Masanpham');
    }

}
