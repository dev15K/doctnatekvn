<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function generate(Request $request, $id)
    {
        $url = route('product.show', $id);
        return QrCode::size(300)->generate($url);
    }

    public function display(Request $request, $id)
    {
        $title = 'Quản lý văn bản NHO';
        $url = route('product.show', $id);
        return view('qrcode.display', compact('title', 'url'));
    }
}
