<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public static function combinateLayers($layers, $i = 0)
    {
        if (!isset($layers[$i])) {
            return [];
        }
        if ($i == count($layers) - 1) {
            return $layers[$i];
        }
        $tmp = self::combinateLayers($layers, $i + 1);
        $result = [];
        foreach ($layers[$i] as $v) {
            foreach ($tmp as $t) {
                $result[] = is_array($t) ? array_merge(array ($v), $t) : array ($v, $t);
            }
        }

        return $result;
    }

}
