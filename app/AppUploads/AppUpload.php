<?php 

namespace App\AppUploads;

abstract class AppUpload
{
    abstract public function GetData( $data): array;
}