<?php

namespace App\Exports;

use App\Models\KontenArtikel;
use Maatwebsite\Excel\Concerns\FromCollection;

class ArtikelPemilikExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return KontenArtikel::select("*")    
                            ->where('role', 1)
                            ->orderBy('created_at', 'desc')
                            ->get();
    }
}
