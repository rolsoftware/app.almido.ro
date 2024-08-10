<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    public function collection(): Collection
    {
        return User::select('id', 'name', 'email', 'created_at', 'active')->where('active', 'Yes')->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Utilizator',
            'Nume',
            'Email',
            'Created at',
            'Active',
        ];
    }
}
