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

    public function index()
    {
        return view('admin.upload.index');
    }

    public function postImportExcel(Request $request){

        $file = $request->file('file');
        $this->excel->import(new PacienteImport, $file);
        
        
        session()->flash('message', 'Importacion de paciente completada');
        
        //return redirect()->route('main');

        return 'Registro Exitoso...';
   
    }
}
