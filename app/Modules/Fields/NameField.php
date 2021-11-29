<?php

namespace App\Modules\Fields;

use Tanthammar\TallForms\BaseField;
use Tanthammar\TallForms\Input;

class NameField implements FieldInterface {

    public function field() : BaseField {
        return Input::make('Name')->rules('required');
    }

}
