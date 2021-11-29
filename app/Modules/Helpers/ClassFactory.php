<?php

namespace App\Modules\Helpers;

use Illuminate\Support\Collection;

class ClassFactory
{
    public static function make($functionClass): Collection
    {
        $me = new static;

        $result = collect([]);

        switch ($functionClass) {

            case 'fields':
                $result = $me->fields();
                break;

            default:
                break;
        }

        return $result;
    }

    public function fields(): Collection
    {
        $result = collect([]);
        foreach (glob(base_path('app/Modules/Fields/*.php')) as $filename) {
            $base = "App\\Modules\\Fields\\";
            $filename = pathinfo($filename)['filename'];
            if (in_array("{$base}FieldInterface", class_implements("{$base}{$filename}"))) {
                $result->push("{$base}{$filename}");
            }
        }
        return $result;
    }
}
