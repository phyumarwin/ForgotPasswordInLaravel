<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadManger extends Controller
{
    function uploadFile(Request $request)
    {
        $request->validate([
            'fileUpload' => 'required|max:20478'
        ]);
        $file = $request->file('fileUpload');
        return $file->storeAs('images','fileone.'.$file->getClientOriginalExtension());
    }
}
