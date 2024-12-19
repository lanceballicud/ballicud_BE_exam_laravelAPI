<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;

class VideoController extends Controller
{
    public function list() {
        $path = public_path('videos');
        $files = FacadesFile::files($path);

        $videos = array_map(function ($file) {
            return $file->getFilename();
        }, $files);

        return response()->json($videos);
    }
}
