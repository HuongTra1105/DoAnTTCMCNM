<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anhsanpham extends Model
{
    protected $table = 'anhsanpham';

    protected $fillable = [
        'Masanpham',
        'duong_dan_hinh',
        'Anhchinh',
        'TieuDe'
    ];
}
