<?php

namespace App\Exports;

use App\Models\anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class UsersExport implements FromCollection, WithHeadings, WithTitle
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return anggota::select("anggota_nomor", "anggota_nama")->where('status', '=', 'Aktif')->get();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Nomor_Anggota", "Nama_Anggota", "Kode_Simpanan", "Jumlah_Simpanan"];
    }

    public function title(): string
    {
        return 'Simpanan';
    }
}
