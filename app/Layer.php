<?php

namespace App;

use App\Http\Requests\StoreLayer;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Layer extends Model
{
    protected $fillable = ['layer_id', 'image'];

    public static function  variations(){
        $images = Layer::all();
        $rows = [];
        $l = [];
        foreach ($images as $image){
            $rows[$image->layer_id][] = $image->layer_id . '/' .$image->image;
        }
        foreach ($rows as $row) {
            $l[] = $row;
        }
        return (Layer::countRowsavailable() < 2) ? $l : self::combinate($l);
    }

    private static function combinate($layers, $i = 0)
    {
        if (!isset($layers[$i])) {
            return [];
        }
        if ($i == count($layers) - 1) {
            return $layers[$i];
        }
        $tmp = self::combinate($layers, $i + 1);
        $result = [];
        foreach ($layers[$i] as $v) {
            foreach ($tmp as $t) {
                $result[] = is_array($t) ? array_merge(array ($v), $t) : array ($v, $t);
            }
        }

        return $result;
    }

    public static function getImage($path) {
        if (Storage::disk()->exists($path)){
            $file = Storage::disk()->get($path);
            return response($file,200)->header('Content-Type', 'image/png');
        }
    }

    /**
     * @param StoreLayer $request
     * @param Layer $layer
     */
    public static function storeImagen(StoreLayer $request, Layer $layer){

        $image    = $request->file('image');
        $filename =  $image->getClientOriginalName();
        $pathLayer = "stacks/{$request->layer_id}";
        if (!Storage::disk('local')->exists($pathLayer)) {
            Storage::makeDirectory($pathLayer);
        }
        Image::make($image)->save(storage_path("app/" . $pathLayer) . "/$filename");

        $layer->image = $filename;
        $layer->update();
    }

    public static function countRowsavailable(){
        return count(DB::table('layers')->select('layer_id')->groupBy('layer_id')->get());
    }
}
