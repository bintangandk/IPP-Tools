<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $userId;
    protected $role;

    public function __construct($userId, $role)
    {
        $this->userId = $userId;
        $this->role = $role;
    }

    public function collection()
    {
        $query = User::query();

        if ($this->userId) {
            $query->where('user_id', 'like', '%' . $this->userId . '%');
        }

        if ($this->role) {
            $query->where('roles', 'like', '%' . $this->role . '%');
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'User ID',
            'Full Name',
            'Type',
            'Region',
            'Teritory',
            'Status',
            'Level',
            'Roles',
            'Created At',
            'Updated At',
        ];
    }
}
