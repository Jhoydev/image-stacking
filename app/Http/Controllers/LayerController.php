<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLayer;
use App\Layer;

class LayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        switch (Layer::countRowsavailable()){
            case 0:
                return response()->json(['error' => 'no images have been uploaded'], 400);
                break;
            case 1:
                return response()->json(['error' => 'requires at least 1 image uploaded in 2 different rows'],400);
                break;
            default:
                $rows = Layer::variations();
                return response()->json($rows);
                break;

        }
    }

    /**
     * @param StoreLayer $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreLayer $request)
    {
        $image = Layer::create($request->all());
        Layer::storeImagen($request, $image);
        return response()->json('success', 200);
    }

    /**
     * @param $stack_id
     * @param $filename
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function layerImage($stack_id, $filename)
    {
        return Layer::getImage("stacks/$stack_id/$filename");
    }
}
