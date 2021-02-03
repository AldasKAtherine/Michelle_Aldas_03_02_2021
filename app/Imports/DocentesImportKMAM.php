<?php

namespace App\Imports;

use App\Docente;
use Maatwebsite\Excel\Concerns\ToModel;

class DocentesImportKMAM implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $docente = new Docente();
      
        $docente =$docente->where('cedula','=',$row[0])->first();
        if($docente){
            $docente->update([
                'nombres' =>$row[2],
                'correoUTA' =>$row[3],
                'correo' =>$row[4],
                'ceular' =>$row[5],
                'telefono' =>$row[6]
            ]);
            return $docente;
        }else{
            return new Docente([
                'cedula'=>$row[0],
                'nombres' =>$row[2],
                'correoUTA' =>$row[3],
                'correo' =>$row[4],
                'ceular' =>$row[5],
                'telefono' =>$row[6]
            ]);
        }
        
    }
}
