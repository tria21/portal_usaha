<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class PemilikExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select("*")    
        ->where('role', 1)
        ->orderBy('created_at', 'desc')
        ->get();
    }
}
