<?php

namespace App\Exports;

use App\Producto;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AlmacenExport implements FromView
{
    public $id;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        if (count(Producto::where('almacene_id', $this->id)->get())>0) {
            return view('export.all', [
                'productos' => Producto::where('almacene_id', $this->id)->get()
            ]);
        }
        return view('export.all', [
            'productos' => 'no hay'
        ]);

    }
}
