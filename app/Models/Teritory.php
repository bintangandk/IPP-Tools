<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teritory extends Model
{
    
    use HasFactory;

    protected $table = 'teritory';

    protected $fillable = [
        'circle',
        'region',
        'area',
        'sales_area',
        'cluster',
        'micro_cluster',
        'partner_teritory',
        'partner',
        'type',
        'kecamatan_unik',
        'kecamatan',
        'kabupaten',
        'mc_type',
        'flag_prog',
        'flag',
    ];
}
