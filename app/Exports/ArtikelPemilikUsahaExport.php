<?php

namespace App\Exports;

use App\Models\KontenArtikel;
use Maatwebsite\Excel\Concerns\FromCollection;

class ArtikelPemilikUsahaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return KontenArtikel::select("*")    
                            ->where('id_user', session('loginId'))
                            ->orderBy('created_at', 'desc')
                            ->get();
    }
}
