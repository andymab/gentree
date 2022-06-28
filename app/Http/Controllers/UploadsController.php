<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppUploads\Uploads\Csv_parser;

class UploadsController extends Controller
{
    public function index()
    {
        $i = new Csv_parser();

        echo "<pre>";
        print_r($i->GetData('123'));
        //return $i->GetData('123');
    }

    public function Post()
    { //потом дописать

        $i = new Csv_parser();
        return $i->GetData('123');

        
    }
}
