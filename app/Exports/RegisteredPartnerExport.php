<?php

namespace App\Exports;

use App\Models\RegisteredPartner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegisteredPartnerExport implements FromCollection, WithHeadings
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

        return $query->select([
            'submission_date', 'circle', 'region', 'kecamatan', 'kabupaten',
            'kecamatan_unik', 'longitude', 'latitude', 'im3_outlet_id',
            'im3_outlet_name', '3id_qr_code', '3id_outlet_name',
            'service', 'branding', 'post_paid', 'pks',
            'upload_branding', 'name_owner', 'nik_owner',
            'npwp_owner', 'email_owner', 'im3_3id_users',
        ])->get();
    }

    public function headings(): array
    {
        return [
            'SUBMISSION_DATE',
            'CIRCLE',
            'REGION',
            'KECAMATAN',
            'KABUPATEN',
            'KECAMATAN_UNIK',
            'LONGITUDE',
            'LATITUDE',
            'IM3_OUTLET_ID',
            'IM3_OUTLET_NAME',
            '3ID_QR_CODE',
            '3ID_OUTLET_NAME',
            'Service',
            'Branding',
            'Post_Paid',
            'Upload_PKS',
            'Upload_Branding',
            'Nama_Owner',
            'NIK_Owner',
            'NPWP_Owner',
            'Email_Owner',
            'IM3_3ID_Users',
        ];
    }
}
