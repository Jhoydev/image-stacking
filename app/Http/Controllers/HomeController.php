<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $images = Image::all();
        $layers = [];
        $l = [];
        foreach ($images as $image){
            $layers[$image->layer_id][] = $image->layer_id . '/' .$image->image;
        }

        foreach ($layers as $layer) {
            $l[] = $layer;
        }
        $layers = Image::combinateLayers($l);
        return view('home', compact('layers'));
    }
}
