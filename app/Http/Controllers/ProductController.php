<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Products::find($id);

        if (!$product) {
            return redirect(route('error.not.found'));
        }

        $fileUrl = $product->file;
        $filePath = parse_url($fileUrl, PHP_URL_PATH);
        $filePath = str_replace("/storage", "", $filePath);
        $mimeType = null;
        if ($filePath && Storage::exists('public' . $filePath)) {
            $mimeType = Storage::mimeType('public' . $filePath);
        }

        return view('product', compact('product', 'mimeType', 'filePath'));
    }
}
