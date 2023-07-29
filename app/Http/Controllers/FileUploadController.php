<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\S3\S3Client;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{

    public function index(Request $request)
    {
        return view('upload.index');
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        if ($file) {
            $path = $file->store('uploads', 's3');
            // return Storage::disk('s3')->url($path);
            // return Storage::disk('s3')->temporaryUrl($path, now()->addMinutes(10));
            return Storage::disk('s3')->response($path);
        } else {
            return "No file selected.";
        }
    }
}
