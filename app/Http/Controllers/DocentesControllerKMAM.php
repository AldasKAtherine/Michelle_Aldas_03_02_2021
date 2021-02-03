<?php

namespace App\Http\Controllers;

use App\Docente;
use App\Imports\DocentesImportKMAM;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DocentesControllerKMAM extends Controller
{
    //
    public function index(){
        $docentes = Docente::all();

        return view('docentes.indexKMAM',['docentes'=>$docentes]);
    }

    public function importExcelKMAM(Request $request){
        $request->validate([
            'file' => ['required','mimes:xls,xlsx'],
        ]);
       
        try {
        $file = $request->file("file");
        Excel::import(new DocentesImportKMAM,$file);
        return back()->with('mensaje','El listado ha sido registrado correctamente!!');
        }catch(\Exception $e){
            return back()->with('mensaje', $e);
        }
    }
}
