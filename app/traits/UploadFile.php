<?php
namespace App\traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadFile{
    public function UploadFiles(UploadedFile $file, $disk = 'public', $fileName = null){
        $FileName = Str::random(10)."_".date('Y_m_d');
        return $file->storeAs($disk, $FileName.".".$file->getClientOriginalExtension());
    }
}
