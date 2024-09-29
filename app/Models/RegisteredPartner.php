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
        'kecamatan_unik',
        'longitude',
        'latitude',
        'im3_outlet_id',
        'im3_outlet_name',
        '3id_qr_code',
        '3id_outlet_name',
        'service',
        'branding',
        'post_paid',
        'pks',
        'upload_branding',
        'name_owner',
        'nik_owner',
        'npwp_owner',
        'email_owner',
        'im3_3id_users',
    ];
}
