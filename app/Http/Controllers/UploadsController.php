<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppUploads\Uploads\Csv_parser;
use Illuminate\Support\Facades\Storage;

class UploadsController extends Controller
{

   public function index(){
    return view('forms.index');
   }

    public function uploadcsv(Request $request)
    {

        $file = $request->file('filecsv');
        $mimetype = $file->getClientMimeType();
        if($mimetype != "text/csv"){
            $request->session()->flash('status', 'Файлы с раширением '.$mimetype . " не обслуживаются, Выберите другой файл");
        }

        $i = new Csv_parser();


        $result = $i->GetData($file); //array
        $format_out = $request->output;
        if(method_exists($this,mb_strtolower($format_out))){
          return $this->$format_out($result);
        }

    }


    public function to_json($data){
        file_put_contents(storage_path('tmp/file.json'),json_encode($data,JSON_UNESCAPED_UNICODE));
        $path = storage_path('tmp/file.json');
        return response()->download($path, basename($path));
    }

    public function to_display($data){
        return view('showdata', compact('data'));

    }

}
