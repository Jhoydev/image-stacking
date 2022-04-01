<?php

namespace App\Http\Controllers;

use App\Layer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class HomeController extends Controller
{
    public function index(){
        $layers_id = DB::table('layers')->select('layer_id')->groupBy('layer_id')->get();
        return view('home', compact('layers_id'));
    }

    public function store(Request $request){

        if (!$request->hasFile('image')){
            return response('image required', 400);
        }

        $layer    = $request->file('image');
        $filename =  $layer->getClientOriginalName();

        $countExistLayer =  Layer::where('image', $filename)
            ->where('layer_id', $request->layer_id)->exists();
        if ($countExistLayer){
            return response('Error', 400);
        }

        $countExistLayer =  Layer::where('image', $filename)->count();
        if ($countExistLayer >= 4){
            return response('Error', 400);
        }

        $image = Layer::create($request->all());
        $layer    = $request->file('image');
        $filename =  $layer->getClientOriginalName();
        $pathLayer = "stacks/{$request->layer_id}";
        if (!Storage::disk('local')->exists($pathLayer)) {
            Storage::makeDirectory($pathLayer);
        }
        Image::make($layer)->save(storage_path("app/" . $pathLayer) . "/$filename");
        $image->image = $filename;
        $image->update();
        return back();
    }

    public function layerImage($stack_id, $filename)
    {
        return Layer::getImage("stacks/$stack_id/$filename");
    }

}
