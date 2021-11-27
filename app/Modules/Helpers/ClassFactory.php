<?php

namespace App\Modules\Helpers;

use App\Modules\Fields\FieldsInterface;
use Illuminate\Support\Collection;

class ClassFactory
{
    public static function make($functionClass): Collection
    {
        $factory = new static;

        if ($functionClass === 'fields') {
            return $factory->fields();
        }

        return collect([]);
    }

    public function fields(): Collection
    {
        $result = collect([]);
        foreach (glob(base_path('app/Modules/Fields/*.php')) as $filename) {
            $fqcn = sprintf('App\\Modules\\Fields\\%s', pathinfo($filename)['filename']);
            if (class_exists($fqcn) && in_array(FieldsInterface::class, class_implements($fqcn), true)) {
                $result->push($fqcn);
            }
        }

        return $result;
    }
}
