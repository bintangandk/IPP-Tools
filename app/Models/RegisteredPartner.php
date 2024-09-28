<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredPartner extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_date',
        'circle',
        'region',
        'kecamatan',
        'kabupaten',
        'longitude',
        'latitude',
        'im3_outlet_id',
        'im3_outlet_name',
        'qr_code',
        'outlet_name',
    ];
}
