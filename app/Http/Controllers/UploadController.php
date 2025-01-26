<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\traits\UploadFile;
use App\Jobs\ProcessImportJob;
use App\Jobs\ProductsImport\ProcessProductImportJob;

class UploadController extends Controller
{
    use UploadFile;
    public function index(){
        return view('upload');
    }

    public function upload(Request $request){
        if($request->hasFile('file')){
            $path = $this->UploadFiles($request->file('file'));
            ProcessImportJob::dispatch('app/'.$path);
        }
    }
}
