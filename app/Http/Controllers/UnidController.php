<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Producto;
use App\Unid;

class UnidController extends Controller
{
    
    public function updateUnid($unid, Request $request)
    {
        $unidad = Unid::find($unid);
        $unidad->update($request->all());
        
        return redirect()->route('producto.show', ['producto'=>$unidad->producto])->with('info', 'unidad actualizada');

    }


    public function destroy($unid)
    {
        $unidad = Unid::find($unid);
        $unidad->delete();

        return redirect()->route('producto.show', ['producto'=>$unidad->producto])->with('info', 'unidad borrada');

    }

}
