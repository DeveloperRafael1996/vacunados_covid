<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Imports\PacienteImport;


class ImporExcelController extends Controller
{
    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function postImportExcel(Request $request){

        $file = $request->file('file');
        return $this->excel->import(new PacienteImport, $file);
        return back()->with('message','Importacion de paciente completada');
        
    }
}
