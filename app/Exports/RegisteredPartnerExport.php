<?php

namespace App\Exports;

use App\Models\RegisteredPartner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; // Tambahkan ini

class RegisteredPartnerExport implements FromCollection, WithHeadings // Implementasikan WithHeadings
{
    protected $circle, $region, $area, $sales_area, $userLevel;

    public function __construct($circle, $region, $area, $sales_area, $userLevel) {
        $this->circle = $circle;
        $this->region = $region;
        $this->area = $area;
        $this->sales_area = $sales_area;
        $this->userLevel = $userLevel;
    }

    public function collection()
    {
        $query = RegisteredPartner::query();

        if ($this->userLevel == 'Admin') {
            if ($this->circle && $this->circle !== 'semua') {
                $query->where('circle', $this->circle);
            }
            if ($this->region && $this->region !== 'semua') {
                $query->where('region', $this->region);
            }
            if ($this->area && $this->area !== 'semua') {
                $query->where('kabupaten', $this->area);
            }
            if ($this->sales_area && $this->sales_area !== 'semua') {
                $query->where('kecamatan', $this->sales_area);
            }
        } else {
            $query->where('region', '=', auth()->user()->region);
            if ($this->circle && $this->circle !== 'semua') {
                $query->where('circle', $this->circle);
            }
            if ($this->area && $this->area !== 'semua') {
                $query->where('kabupaten', $this->area);
            }
            if ($this->sales_area && $this->sales_area !== 'semua') {
                $query->where('kecamatan', $this->sales_area);
            }
        }

        // Kembalikan data yang sesuai dengan heading
        return $query->select([
            'submission_date','circle', 'region', 'kecamatan', 'kabupaten',
            'longitude', 'latitude', 'im3_outlet_id', 'im3_outlet_name',
            'qr_code', 'outlet_name', 'created_at', 'updated_at',
        ])->get();
    }

    // Implementasi heading untuk Excel
    public function headings(): array
    {
        return [
            'submission_date','circle', 'region', 'kecamatan', 'kabupaten',
            'longitude', 'latitude', 'im3_outlet_id', 'im3_outlet_name',
            'qr_code', 'outlet_name', 'created_at', 'updated_at',
        ];
    }
}
