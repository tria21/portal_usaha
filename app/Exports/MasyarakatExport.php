<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class MasyarakatExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select("*")    
                    ->where('role', 2)
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
}
