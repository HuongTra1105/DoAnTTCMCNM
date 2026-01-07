<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NguoiDung extends Model
{
    protected $table = 'nguoidung';

    protected $fillable = [
        'Manguoidung',
        'Ten',
        'email',
        'MatKhau',
        'Vaitro',
        'TrangThai',
        'otp',
        'otp_expires_at'
    ];

    protected $hidden = ['MatKhau'];
    protected $casts = [
        'otp_expires_at' => 'datetime',
        'email_verified_at' => 'datetime'
    ];
}
