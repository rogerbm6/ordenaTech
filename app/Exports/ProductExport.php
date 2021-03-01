<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use App\Producto;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ProductExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.all', [
            'productos' => Producto::all()
        ]);
    }
}
