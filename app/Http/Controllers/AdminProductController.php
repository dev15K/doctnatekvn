<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function list()
    {
        $products = Products::paginate(20);
        return view('admin.products.list', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        try {
            if ($request->hasFile('file_upload')) {
                $item = $request->file('file_upload');
                $itemPath = $item->store('files', 'public');
                $file_upload = asset('storage/' . $itemPath);
                $file_name = $item->getClientOriginalName();
            } else {
                return back()->with('error', 'File not found');
            }

            $notes = $request->input('notes');

            $product = new Products();
            $product->notes = $notes;
            $product->filename = $file_name;
            $product->file = $file_upload;
            $product->save();
            return redirect(route('admin.products.list'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        try {
            $product = Products::find($id);
            if (!$product) {
                return redirect(route('error.not.found'));
            }

            if ($request->hasFile('file_upload')) {
                $item = $request->file('file_upload');
                $itemPath = $item->store('files', 'public');
                $file_upload = Storage::url($itemPath);
                $file_name = $item->getClientOriginalName();

                $product->filename = $file_name;
                $product->file = $file_upload;
            }

            $notes = $request->input('notes');

            $product->notes = $notes;
            $product->save();
            return redirect(route('admin.products.list'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function detail($id)
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

        return view('admin.products.detail', compact('product', 'mimeType', 'filePath'));
    }

    public function delete($id)
    {
        try {
            $product = Products::find($id);
            if (!$product) {
                return redirect(route('error.not.found'));
            }

            $product->delete();
            return redirect(route('admin.products.list'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
}
