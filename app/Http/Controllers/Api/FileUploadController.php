<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    /**
     * Store file in the storage folder
    * @param Request $request
    * @return Response
    */
    public function upload(Request $request)
    {
        $file = $request->file('file');
        

        if($file == false) return -1;

        $mime = $file->getMimeType();
        $type =  explode('/', $mime, 2);
        $type = isset($type[0]) ? $type[0] : '';

        if('image' != $type){
            return -2;
        }

        $temp = $file->storePublicly('public/products');

        if($temp){
            return response([
                'result' => 'success',
                'file' => basename($temp)
            ]);
        }
        return 0;
    }
}
