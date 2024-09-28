<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'images' => "required|array",
            'images.*' => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        ]);
        dd($data);
    }
}
