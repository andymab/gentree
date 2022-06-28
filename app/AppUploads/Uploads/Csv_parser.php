<?php

namespace App\AppUploads\Uploads;

use App\AppUploads\AppUpload;
use Facade\Ignition\Middleware\AddLogs;
use Illuminate\Support\Arr;
use PhpParser\Node\Stmt\TryCatch;

class Csv_parser extends AppUpload
{
    private $data;
    private $size;
    private $parents;
    private $childrens;
    private $result_array;

    public function __construct()
    {
        $this->childrens = [];
        $this->result_array = [];
    }


   public function GetData($file): array
    {

        $data = file(storage_path('input.csv'));
        $this->data = array_map(fn($row)=>(str_getcsv($row,';',"\"")), $data);

       // dd($this-> buildTree($this->data));
        return $this-> buildTree($this->data);
    }


    private function brancchild(array &$elements, $parentId = '') {
        $branch = array();
    //     "itemName": "Total",
    // "parent": null,
    // "children": [
        foreach ($elements as $element) {
            // $element['itemName'] = $element[0];
             $element['parent'] = $element[2];

            // unset($element[0]);
            // unset($element[1]);
             unset($element[2]);
            // unset($element[3]);

            if ($element['parent'] == $parentId) {
                $children = $this -> buildTree($elements, $element[0]);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element; //ветка может тут и не заканчиваться
               // unset($elements[$element[0]]);
            }

        }
        return $branch;
    }   


   private function buildTree(array &$elements, $parentId = '') {
        $branch = array();
    //     "itemName": "Total",
    // "parent": null,
    // "children": [


        foreach ($elements as $element) {
            // $element['itemName'] = $element[0];
             $element['parent'] = $element[2];

            // unset($element[0]);
            // unset($element[1]);
             unset($element[2]);
            // unset($element[3]);

            if ($element['parent'] == $parentId) {
                $children = $this -> buildTree($elements, $element[0]);
                if ($children) {
                    $element['children'] = $children;
                }

                if($element[1] == "Прямые компоненты"){
                    //echo 
                    $children = $this -> brancchild($elements, $element[3]);
                    if ($children) {
                        $element['children'] = $children;
                    }               
                }


                $branch[] = $element; //ветка может тут и не заканчиваться
               // unset($elements[$element[0]]);
            }

            // if($element[1] == 'Прямые компоненты' && $element[3]){
            //     $children = $this -> buildTree($elements, $element[3]);
            //     if ($children) {
            //         $element['children'] = $children;
            //     }
            //     $branch[] = $element;
            // }

        }
        return $branch;
    }   

}
