<?php

namespace App\Http\Controllers\Api\upload;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate(['image' => 'required|file|max:5120']);
        $path = $request->file('image')->store('uploads', 'public');
        return response()->json(['path' => $path, 'url' => Storage::disk('public')->url($path)]);
    }

    public function uploadMultipleImages(Request $request)
    {
        $request->validate(['images' => 'required|array', 'images.*' => 'file|max:5120']);
        $out = [];
        foreach ($request->file('images', []) as $file) {
            $path = $file->store('uploads', 'public');
            $out[] = ['path' => $path, 'url' => Storage::disk('public')->url($path)];
        }
        return response()->json($out);
    }

    public function uploadFile(Request $request)
    {
        $request->validate(['file' => 'required|file|max:20480']);
        $path = $request->file('file')->store('uploads', 'public');
        return response()->json(['path' => $path, 'url' => Storage::disk('public')->url($path)]);
    }

    public function deleteImage(Request $request)
    {
        $data = $request->validate(['path' => 'required|string']);
        Storage::disk('public')->delete($data['path']);
        return response()->json(['success' => true]);
    }
}


