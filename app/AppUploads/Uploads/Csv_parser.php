<?php

namespace App\AppUploads\Uploads;

use App\AppUploads\AppUpload;

class Csv_parser extends AppUpload
{
    private $data;

    public function __construct()
    {
        $this->childrens = [];
        $this->result_array = [];
    }


   public function GetData($file): array
    {

        $data = file($file);
        $this->data = array_map(fn($row)=>(str_getcsv($row,';',"\"")), $data);

        return $this-> buildTree($this->data);
    }


    private function brancchild(array &$elements, $parentId = '') {
        $branch = array();
        foreach ($elements as $element) {
             $element['parent'] = $element[2];
             unset($element[2]);

            if ($element['parent'] == $parentId) {
                $children = $this -> buildTree($elements, $element[0]);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element; //ветка может тут и не заканчиваться
            }

        }
        return $branch;
    }   

   private function buildTree(array &$elements, $parentId = '') {
        $branch = array();
        foreach ($elements as $element) {
             $element['parent'] = $element[2];

             unset($element[2]);

            if ($element['parent'] == $parentId) {
                $children = $this -> buildTree($elements, $element[0]);
                if ($children) {
                    $element['children'] = $children;
                }

                if($element[1] == "Прямые компоненты"){
                    $children = $this -> brancchild($elements, $element[3]);
                    if ($children) {
                        $element['children'] = $children;
                    }               
                }


                $branch[] = $element; //ветка может тут и не заканчиваться
            }
        }
        return $branch;
    }   

}
